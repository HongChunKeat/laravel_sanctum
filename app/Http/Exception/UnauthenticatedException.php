<?php

namespace App\Http\Exception;

use Illuminate\Auth\AuthenticationException as Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnauthenticatedException extends Exception
{
    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */

    protected function unauthenticated(Request $request, Exception $exception): Response
    {
        return $request->isJson() || $request->expectsJson()
            ? response()->json([
                "success" => false,
                "data" => "401",
                "msg" => $exception->getMessage()
            ], 401)
            : redirect()->guest($exception->redirectTo($request) ?? redirect("401.html"));;
    }
}
