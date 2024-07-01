<?php

use App\Http\Middleware\CorsMiddleware;
use App\Http\Middleware\PathDetectorMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        $middleware->append([
            CorsMiddleware::class,
            PathDetectorMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // override default unauthenticated response
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                "success" => false,
                "data" => [strtolower(rtrim($e->getMessage(), "."))],
                "msg" => "401"
            ], 401);
        });
    })->create();
