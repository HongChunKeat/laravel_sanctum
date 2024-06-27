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

class Ask extends Base
{
    # [validation-rule]
    protected $rule = [
        "address" => "required|min:42|max:42|alpha_num",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "address"
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
            $res = "";

            # [process]
            if (count($cleanVars) > 0) {
                $res = AdminProfileLogic::newAuthKey($cleanVars["address"]);
            }

            # [result]
            if ($res) {
                $user = AccountAdminModel::where("web3_address", $cleanVars["address"])->first();
                LogAdminModel::log($request, "request", "account_admin", $user["id"]);
                $this->response = [
                    "success" => true,
                    "data" => $res,
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

        # [condition]
        if (isset($params["address"])) {
            $user = AccountAdminModel::where("web3_address", $params["address"])->first();

            // status: active, inactivated, freezed, suspended
            if ($user) {
                if ($user["status"] === "inactivated") {
                    $this->error[] = "account:inactivated";
                } else if ($user["status"] === "freezed") {
                    $this->error[] = "account:freezed";
                } else if ($user["status"] === "suspended") {
                    $this->error[] = "account:suspended";
                } else if ($user["status"] === "active") {
                    $this->successPassedCount++;
                }
            } else {
                $this->error[] = "account:missing";
            }
        }
    }
}
