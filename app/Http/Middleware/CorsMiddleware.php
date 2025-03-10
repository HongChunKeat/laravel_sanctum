<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    public function handle(Request $request, Closure $handler): Response
    {
        // 如果是options请求则返回一个空响应，否则继续向洋葱芯穿越，并得到一个响应
        $response = $request->method() == "OPTIONS" ? response("") : $handler($request);

        // add header to response
        $response->withHeaders([
            "Access-Control-Allow-Credentials" => "true",
            "Access-Control-Allow-Origin" => $request->header("origin", "*"),
            "Access-Control-Allow-Methods" => $request->header("access-control-request-method", "*"),
            "Access-Control-Allow-Headers" => $request->header("access-control-request-headers", "*"),
        ]);

        return $response;
    }
}
