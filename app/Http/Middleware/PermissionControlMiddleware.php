<?php

namespace App\Http\Middleware;

# system lib
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
# database & logic
use App\Model\Database\AdminPermissionModel;
use App\Model\Database\PermissionTemplateModel;
use App\Model\Database\PermissionWarehouseModel;
use App\Model\Logic\HelperLogic;

//   - PERMISSION: 从 JWT 的信息内获得 用户资讯
//   - PERMISSION: 用户是否拥有执行权限
class PermissionControlMiddleware
{
    protected $ignore = "*";

    public function handle(Request $request, Closure $handler): Response
    {
        $proceed = false;
        $route = $request->route;

        if (isset($request->visitor->id)) {
            $pathMethod = HelperLogic::buildActionCode($route->getPath(), $route->getMethods()[0]);
            $getPath = PermissionWarehouseModel::where("from_site", "admin")
                ->where("code", $pathMethod)
                ->first();

            $role = AdminPermissionModel::where("admin_uid", $request->visitor->id)->first();
            if ($role) {
                $getPermission = PermissionTemplateModel::where("id", $role["role"])->first();

                if (
                    $getPath && $getPermission &&
                    (in_array($pathMethod, json_decode($getPermission->rule)) ||
                        in_array($this->ignore, json_decode($getPermission->rule)))
                ) {
                    $proceed = true;
                }
            }
        }

        // proceed to onion core
        return $proceed
            ? $handler($request)
            : response()->json([
                "success" => false,
                "data" => ["no_permission"],
                "msg" => "403"
            ], 403);
    }
}
