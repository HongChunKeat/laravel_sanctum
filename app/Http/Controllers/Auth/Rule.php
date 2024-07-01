<?php

namespace App\Http\Controllers\Auth;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\AdminPermissionModel;
use App\Model\Database\PermissionTemplateModel;

class Rule extends Base
{
    public function index(Request $request)
    {
        # user id`
        if (!isset($request->user()["id"])) {
            return $this->tokenError();
        } else {
            $cleanVars["uid"] = $request->user()["id"];
        };

        # [proceed]
        $role = AdminPermissionModel::where("admin_uid", $cleanVars["uid"])->first();
        if ($role) {
            $permission = PermissionTemplateModel::where("id", $role["role"])->first();

            if ($permission) {
                $this->response = [
                    "success" => true,
                    "data" => json_decode($permission["rule"]),
                ];
            }
        }

        # [standard output]
        return $this->output();
    }
}
