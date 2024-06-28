<?php

namespace App\Http\Controllers\Auth;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\LogAdminModel;
use App\Model\Database\AccountAdminModel;
use App\Model\Logic\AdminProfileLogic;
use App\Model\Logic\HelperLogic;

class Verify extends Base
{
    # [validation-rule]
    protected $rule = [
        "address" => "required|min:42|max:42|alpha_num",
        "sign" => "required|max:255",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "address",
        "sign",
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
        if (!count($this->error) && ($this->successTotalCount == $this->successPassedCount)) {
            $user = "";

            # [process]
            if (count($cleanVars) > 0) {
                $user = AccountAdminModel::where("web3_address", $cleanVars["address"])->first();
            }

            if ($user) {
                AccountAdminModel::where("id", $user["id"])->update(["authenticator" => "web3_address"]);
                LogAdminModel::log($request, "login", "account_admin", $user["id"]);
                $this->response = [
                    "success" => true,
                    "data" => [
                        "token_type" => "Bearer",
                        "expires_in" => 10800,
                        "access_token" => AdminProfileLogic::newAccessToken($user),
                    ],
                ];
            }
        }

        # [standard output]
        return $this->output();
    }

    private function checking(array $params = [])
    {
        # [init success condition]
        $this->successTotalCount = 1;

        if (isset($params["address"]) && isset($params["sign"])) {
            if (!AdminProfileLogic::verifyAuthKey(strtolower($params["address"]), strtolower($params["sign"]), 1)) {
                $this->error[] = "verify:invalid";
            } else {
                $this->successPassedCount++;
            }
        }
    }
}
