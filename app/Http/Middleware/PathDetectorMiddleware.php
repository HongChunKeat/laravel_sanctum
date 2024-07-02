<?php

namespace App\Http\Middleware;

# system lib
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
# database & logic
use App\Model\Database\PermissionWarehouseModel;
use App\Model\Logic\HelperLogic;

class PathDetectorMiddleware
{
    protected $onlyMethods = ["POST", "GET", "PATCH", "PUT", "DELETE"];

    public function handle(Request $request, Closure $handler): Response
    {
        $proceed = false;

        $route = $request->route();
        $path = $route->uri();
        $method = $route->methods()[0];

        // valid method
        if (!empty($path) && !empty($method) && in_array($method, $this->onlyMethods)) {
            $pathMethod = HelperLogic::buildActionCode($path, $method);
            // Log::info($pathMethod);

            // check if the permission in warehouse
            $getPath = PermissionWarehouseModel::where(["from_site" => "admin", "code" => $pathMethod])->first();

            if ($getPath) {
                $proceed = true;
            } else {
                $created = PermissionWarehouseModel::create([
                    "code" => $pathMethod,
                    "from_site" => "admin",
                    "path" => $path,
                    "action" => $method,
                ]);

                if ($created) {
                    $proceed = true;
                }
            }
        }

        // proceed to onion core
        return $proceed
            ? $handler($request)
            : response()->json([
                "success" => false,
                "data" => ["not_found"],
                "msg" => "404"
            ], 404);
    }
}
