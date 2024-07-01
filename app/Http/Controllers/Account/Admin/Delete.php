<?php

namespace App\Http\Controllers\Account\Admin;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\LogAdminModel;
use App\Model\Database\AccountAdminModel;
use App\Model\Database\AdminPermissionModel;

class Delete extends Base
{
    public function index(Request $request, int $targetId = 0)
    {
        # [process]
        $res = AccountAdminModel::where("id", $targetId)->delete();

        if ($res) {
            AdminPermissionModel::where("admin_uid", $targetId)->delete();
            LogAdminModel::log($request, "delete", "account_admin", $targetId);
            $this->response = [
                "success" => true,
            ];
        }

        # [standard output]
        return $this->output();
    }
}
