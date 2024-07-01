<?php

namespace App\Http\Controllers\Account\User;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\LogAdminModel;
use App\Model\Database\AccountUserModel;
use App\Model\Logic\HelperLogic;

class Update extends Base
{
    # [validation-rule]
    protected $rule = [
        "web3_address" => "min:42|max:42|alpha_num",
        "nickname" => "max:20",
        "password" => "min:8|max:16",
        "tag" => "",
        "authenticator" => "",
        "status" => "in:active,inactivated,freezed,suspended",
        "remark" => "",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "web3_address",
        "nickname",
        "password",
        "tag",
        "authenticator",
        "status",
        "remark"
    ];

    public function index(Request $request, int $targetId = 0)
    {
        # [validation]
        $this->validation($request->input(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->input(), $this->patternInputs, 1, ["status"]);

        # [checking]
        $this->checking(["id" => $targetId] + $cleanVars);

        # [proceed]
        if (!count($this->error)) {
            $res = "";

            # [process]
            if (count($cleanVars) > 0) {
                if (!empty($cleanVars["password"])) {
                    $cleanVars["password"] = password_hash($cleanVars["password"], PASSWORD_DEFAULT);
                }

                $res = AccountUserModel::where("id", $targetId)->update($cleanVars);
            }

            # [result]
            if ($res) {
                LogAdminModel::log($request, "update", "account_user", $targetId);
                $this->response = [
                    "success" => true
                ];
            }
        }

        # [standard output]
        return $this->output();
    }

    private function checking(array $params = [])
    {
        # [condition]
        if (!empty($params["web3_address"])) {
            if (AccountUserModel::where("web3_address", $params["web3_address"])
                ->whereNot("id", $params["id"])
                ->first()
            ) {
                $this->error[] = "web3_address:exists";
            }
        }

        if (!empty($params["nickname"])) {
            if (AccountUserModel::where("nickname", $params["nickname"])
                ->whereNot("id", $params["id"])
                ->first()
            ) {
                $this->error[] = "nickname:exists";
            }
        }

        // check password
        if (!empty($params["password"])) {
            if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?!.*\s).+$/", $params["password"])) {
                $this->error[] = "password:must_have_capital_letter_lower_letter_and_numeric";
            }
        }
    }
}
