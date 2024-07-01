<?php

namespace App\Http\Controllers\Auth;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\LogAdminModel;
use App\Model\Logic\AdminProfileLogic;

class Logout extends Base
{
    public function index(Request $request)
    {
        # user
        $user = $request->user();

        # [proceed]
        $res = "";

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
