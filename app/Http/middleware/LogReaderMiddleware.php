<?php

namespace app\middleware;

# system lib
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
# database & model
use app\model\logic\SettingLogic;

class LogReaderMiddleware
{
    public function process(Request $request, callable $handler): Response
    {
        $proceed = false;

        if (SettingLogic::get("general", ["category" => "log_reader", "code" => "allow_access", "value" => 1])) {
            $proceed = true;
        }

        return ($proceed)
            ? $handler($request)
            : redirect("401.html");
    }
}
