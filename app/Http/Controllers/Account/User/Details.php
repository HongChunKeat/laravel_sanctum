<?php

namespace App\Http\Controllers\Account\User;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\SettingWalletModel;
use App\Model\Database\SettingOperatorModel;
use App\Model\Database\UserWithdrawModel;
use App\Model\Logic\HelperLogic;
use plugin\dapp\app\model\logic\UserProfileLogic;
use App\Model\Logic\WalletLogic;

class Details extends Base
{
    # [validation-rule]
    protected $rule = [
        "user_id" => "required|max:80",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "user_id",
    ];

    # [outputs-pattern]
    protected $patternOutputs = [
        "id",
        "user_id",
        "web3_address",
        "nickname",
        "status",
        "created_at",
        "wallet",
        "total_wallet",
        "total_withdraw"
    ];

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->input(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->input(), $this->patternInputs);

        # [proceed]
        if (!count($this->error)) {

            # [process]
            // user multi search
            $res = UserProfileLogic::multiSearch($cleanVars["user_id"]);

            # [result]
            if ($res) {
                $success = SettingOperatorModel::where("code", "success")->first();

                $totalAmount = 0;
                $res["wallet"] = SettingWalletModel::select("id", "code")->get();

                foreach ($res["wallet"] as $row) {
                    $amount = WalletLogic::getBalance($res["id"], $row["id"]);
                    $totalAmount += $amount;
                    $row["amount"] = $amount;
                }
                $res["total_wallet"] = $totalAmount;
                $res["total_withdraw"] = UserWithdrawModel::where(["status" => $success["id"], "uid" => $res["id"]])->sum("amount");

                $this->response = [
                    "success" => true,
                    "data" => HelperLogic::formatOutput($res, $this->patternOutputs),
                ];
            }
        }

        # [standard output]
        return $this->output();
    }
}
