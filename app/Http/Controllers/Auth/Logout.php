<?php

namespace App\Http\Controllers\Auth;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\LogAdminModel;
use App\Model\Database\AccountAdminModel;
use App\Model\Logic\AdminProfileLogic;

class Logout extends Base
{
    public function index(Request $request)
    {
        # user id
        if (!isset($request->visitor["id"])) {
            return $this->jwtError();
        } else {
            $cleanVars["uid"] = $request->visitor["id"];
        };

        # [proceed]
        $res = "";

        $user = AccountAdminModel::where("id", $cleanVars["uid"])->first();
        if ($user) {
            $res = AdminProfileLogic::logout($user["admin_id"]);
        }

        # [result]
        if ($res) {
            LogAdminModel::log($request, "logout");

            $this->response = [
                "success" => true,
                "data" => $res,
            ];
        }

        return $this->output();
    }
}
