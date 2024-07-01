<?php

namespace App\Http\Controllers\Account\Admin;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\LogAdminModel;
use App\Model\Database\AccountAdminModel;
use App\Model\Logic\HelperLogic;

class Create extends Base
{
    # [validation-rule]
    protected $rule = [
        "web3_address" => "required|min:42|max:42|alpha_num",
        "nickname" => "max:20",
        "password" => "min:8|max:16",
        "tag" => "",
        "email" => "email|max:128",
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
        "email", 
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
                if(isset($cleanVars["email"])) {
                    $cleanVars["email"] = strtolower($cleanVars["email"]);
                }

                if(isset($cleanVars["password"])) {
                    $cleanVars["password"] = password_hash($cleanVars["password"], PASSWORD_DEFAULT);
                }

                $cleanVars["admin_id"] = HelperLogic::generateUniqueSN("account_admin");
                $res = AccountAdminModel::create($cleanVars);
            }

            # [result]
            if ($res) {
                LogAdminModel::log($request, "create", "account_admin", $res["id"]);
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
        // Check web3_address exists
        if (isset($params["web3_address"])) {
            if (AccountAdminModel::where("web3_address", $params["web3_address"])->first()) {
                $this->error[] = "web3_address:exists";
            }
        }

        // Check nickname exists
        if (isset($params["nickname"])) {
            if (AccountAdminModel::where("nickname", $params["nickname"])->first()) {
                $this->error[] = "nickname:exists";
            }
        }

        // Check email exists, email allow null
        if (isset($params["email"])) {
            if (AccountAdminModel::where("email", $params["email"])->first()) {
                $this->error[] = "email:exists";
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
