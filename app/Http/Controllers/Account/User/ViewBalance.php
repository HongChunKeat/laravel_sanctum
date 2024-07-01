<?php

namespace App\Http\Controllers\Account\User;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\SettingWalletModel;
use App\Model\Logic\HelperLogic;
use App\Model\Logic\WalletLogic;

class ViewBalance extends Base
{
    # [outputs-pattern]
    protected $patternOutputs = [
        "code",
        "amount"
    ];

    public function index(Request $request, int $targetId = 0)
    {
        # [proceed]
        $res = SettingWalletModel::select("id", "code")->get();

        if ($res) {
            # [add and edit column using for loop]
            foreach ($res as $row) {
                $row["amount"] = WalletLogic::getBalance($targetId, $row["id"]) * 1;
            }

            # [result]
            $this->response = [
                "success" => true,
                "data" => HelperLogic::formatOutput($res, $this->patternOutputs, 1),
            ];
        }

        # [standard output]
        return $this->output();
    }
}
