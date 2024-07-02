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

class PermissionControlMiddleware
{
    protected $ignore = "*";

    public function handle(Request $request, Closure $handler): Response
    {
        $proceed = false;

        if (isset($request->user()["id"])) {
            $role = AdminPermissionModel::where("admin_uid", $request->user()["id"])->first();
            if ($role) {
                $route = $request->route();
                $path = $route->uri();
                $method = $route->methods()[0];

                $pathMethod = HelperLogic::buildActionCode($path, $method);
                $getPath = PermissionWarehouseModel::where(["from_site" => "admin", "code" => $pathMethod])->first();
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
