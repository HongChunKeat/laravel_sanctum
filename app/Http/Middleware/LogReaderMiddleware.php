<?php

namespace App\Http\Middleware;

# system lib
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
# database & model
use App\Model\Logic\SettingLogic;

class LogReaderMiddleware
{
    public function handle(Request $request, Closure $handler): Response
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
