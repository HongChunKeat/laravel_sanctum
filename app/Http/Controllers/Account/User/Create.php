<?php

namespace App\Http\Controllers\Account\User;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\LogAdminModel;
use App\Model\Database\AccountUserModel;
use App\Model\Logic\HelperLogic;
use plugin\dapp\app\model\logic\UserProfileLogic;

class Create extends Base
{
    # [validation-rule]
    protected $rule = [
        "web3_address" => "required|min:42|max:42|alpha_num",
        "nickname" => "max:20",
        "password" => "min:8|max:16",
        "tag" => "",
        "authenticator" => "",
        "status" => "required|in:active,inactivated,freezed,suspended",
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

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->input(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->input(), $this->patternInputs);

        # [checking]
        $this->checking($cleanVars);

        # [proceed]
        if (!count($this->error)) {
            $res = "";

            # [process]
            if (count($cleanVars) > 0) {
                if (isset($cleanVars["password"])) {
                    $cleanVars["password"] = password_hash($cleanVars["password"], PASSWORD_DEFAULT);
                }

                $cleanVars["user_id"] = HelperLogic::generateUniqueSN("account_user");
                $res = AccountUserModel::create($cleanVars);
            }

            # [result]
            if ($res) {
                UserProfileLogic::bindUpline($res["id"]);
                UserProfileLogic::init($res["id"]);

                LogAdminModel::log($request, "create", "account_user", $res["id"]);
                $this->response = [
                    "success" => true,
                ];
            }
        }

        # [standard output]
        return $this->output();
    }

    private function checking(array $params = [])
    {
        # [condition]
        if (isset($params["web3_address"])) {
            if (AccountUserModel::where("web3_address", $params["web3_address"])->first()) {
                $this->error[] = "web3_address:exists";
            }
        }

        if (isset($params["nickname"])) {
            if (AccountUserModel::where("nickname", $params["nickname"])->first()) {
                $this->error[] = "nickname:exists";
            }
        }

        // check password
        if (isset($params["password"])) {
            if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?!.*\s).+$/", $params["password"])) {
                $this->error[] = "password:must_have_capital_letter_lower_letter_and_numeric";
            }
        }
    }
}
