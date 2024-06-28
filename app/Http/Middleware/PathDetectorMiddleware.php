<?php

namespace App\Http\Middleware;

# system lib
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\PermissionWarehouseModel;
use App\Model\Logic\HelperLogic;

class PathDetectorMiddleware
{
    protected $ignorePath = ["/{id:\d+}", "/{id}"];
    protected $onlyMethods = ["POST", "GET", "PATCH", "PUT", "DELETE"];

    public function handle(Request $request, Closure $handler): Response
    {
        $proceed = false;

        $route = $request->route;
        // var_export($route->getPath()); // /user/{uid}
        // var_export($route->getMethods()); // ["GET", "POST", "PUT", "DELETE", "PATCH", "HEAD","OPTIONS"]
        // var_export($route->getName()); // user_view
        // var_export($route->getMiddleware()); // []
        // var_export($route->getCallback()); // ["app\\controller\\User", "view"]
        // var_export($route->param()); // ["uid"=>111]
        // var_export($route->param("uid")); // 111

        /**
         * 2 ways to generate code, temporary selected (1)
         * - $route->getPath() + $route->getMehods()[0]
         * - $request->controller + $request->action;
         */
        $pathMethod = HelperLogic::buildActionCode($route->getPath(), $route->getMethods()[0]);

        // valid method
        if ($route && isset($route->getMethods()[0]) && in_array($route->getMethods()[0], $this->onlyMethods)) {
            // check if the permission in warehouse
            $getPath = PermissionWarehouseModel::where("from_site", "admin")
                ->where("code", $pathMethod)
                ->first();

            if ($getPath) {
                $proceed = true;
            } else {
                $created = PermissionWarehouseModel::create([
                    "code" => $pathMethod,
                    "from_site" => "admin",
                    "path" => $route->getPath(),
                    "action" => $route->getMethods()[0],
                ]);

                if ($created) {
                    $proceed = true;
                }
            }
        }

        // proceed to onion core
        return $proceed
            ? $handler($request)
            : [
                "success" => false,
                "data" => "902",
                "msg" => "invalid_path",
            ];
    }
}
