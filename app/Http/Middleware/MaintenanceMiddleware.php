<?php

namespace App\Http\Middleware;

# system lib
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
# database & model
use App\Model\Logic\SettingLogic;

class MaintenanceMiddleware
{
    public function handle(Request $request, Closure $handler): Response
    {
        // check maintenance
        $stopAdmin = SettingLogic::get("general", ["category" => "maintenance", "code" => "stop_admin", "value" => 1]);
        $stopLogin = SettingLogic::get("general", ["category" => "maintenance", "code" => "stop_login", "value" => 1]);
        if ($stopAdmin || $stopLogin) {
            return [
                "success" => false,
                "data" => ["under_maintenance"],
            ];
        } else {
            return $handler($request);
        }
    }
}
