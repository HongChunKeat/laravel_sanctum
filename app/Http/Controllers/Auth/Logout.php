<?php

namespace App\Http\Controllers\Auth;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\AccountAdminModel;
use App\Model\Database\LogAdminModel;
use App\Model\Logic\AdminProfileLogic;

class Logout extends Base
{
    public function index(Request $request)
    {
        # user id
        if (!isset($request->user()["id"])) {
            return $this->tokenError();
        } else {
            $cleanVars["uid"] = $request->user()["id"];
        };

        # [proceed]
        $res = "";

        $user = AccountAdminModel::where("id", $cleanVars["uid"])->first();
        if ($user) {
            $res = AdminProfileLogic::logout($user);
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
