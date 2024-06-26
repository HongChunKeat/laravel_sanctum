<?php

namespace app\middleware;

# system lib
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
# database & model
use app\model\logic\SettingLogic;

class MaintenanceMiddleware
{
    public function process(Request $request, callable $handler): Response
    {
        // check maintenance
        $stopAdmin = SettingLogic::get("general", ["category" => "maintenance", "code" => "stop_admin", "value" => 1]);
        $stopLogin = SettingLogic::get("general", ["category" => "maintenance", "code" => "stop_login", "value" => 1]);
        if ($stopAdmin || $stopLogin) {
            return json_encode([
                "success" => false,
                "data" => ["under_maintenance"],
            ]);
        } else {
            return $handler($request);
        }
    }
}
