<?php

namespace App\Http\Controllers\Account\Admin;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\AccountAdminModel;
use App\Model\Logic\HelperLogic;

class Read extends Base
{
    # [outputs-pattern]
    protected $patternOutputs = [
        "id",
        "admin_id",
        "web3_address",
        "nickname",
        "tag",
        "email",
        "status",
        "remark",
        "created_at",
        "updated_at",
    ];

    public function index(Request $request, int $targetId = 0)
    {
        # [process]
        $res = AccountAdminModel::where("id", $targetId)->first();

        # [result]
        if ($res) {
            $this->response = [
                "success" => true,
                "data" => HelperLogic::formatOutput($res, $this->patternOutputs),
            ];
        }

        # [standard output]
        return $this->output();
    }
}
