<?php

namespace App\Http\Controllers\Account\User;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
use Webman\RedisQueue\Redis as RedisQueue;
# database & logic
use App\Model\Database\LogAdminModel;
use App\Model\Database\AccountUserModel;
use App\Model\Logic\HelperLogic;

class AddBalance extends Base
{
    # [validation-rule]
    protected $rule = [
        "wallet_id" => "required|integer|max_digits:11",
        "amount" => "required|numeric|max:20",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "wallet_id",
        "amount",
    ];

    public function index(Request $request, int $targetId = 0)
    {
        # [validation]
        $this->validation($request->input(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->input(), $this->patternInputs);

        # [checking]
        $this->checking(["id" => $targetId] + $cleanVars);

        # [proceed]
        if (!count($this->error)) {
            # [process with queue]
            RedisQueue::send("userWallet", [
                "type" => "editWallet",
                "data" => [
                    "uid" => $targetId,
                    "walletId" => $cleanVars["wallet_id"],
                    "amount" => $cleanVars["amount"],
                    "type" => "add",
                ]
            ]);

            LogAdminModel::log($request, "add_balance", "account_user", $targetId);
            # [result]
            $this->response = [
                "success" => true,
            ];
        }

        # [standard output]
        return $this->output();
    }

    private function checking(array $params = [])
    {
        # [condition]
        if (isset($params["id"])) {
            // check user exist
            if (!AccountUserModel::where(["id" => $params["id"]])->first()) {
                $this->error[] = "user:invalid";
            }
        }
    }
}
