<?php

namespace App\Http\Middleware;

# system lib
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
# external lib
use Tinywan\Jwt\JwtToken;
# database & model
use App\Model\Database\AccountAdminModel;
use App\Model\Logic\AdminProfileLogic;

class JwtAuthMiddleware
{
    protected $name = "Authorization";
    protected $pattern = "/Bearer\s+(.*)$/i";

    public function process(Request $request, Closure $handler): Response
    {
        $proceed = false;
        $accessToken = "";

        // check header if contain token
        $authorization = $request->header($this->name);
        if ($authorization && preg_match($this->pattern, $authorization, $matches)) {
            $accessToken = $matches[1];
        }

        // check if token extension is correct and valid
        try {
            $jwtInfo = JwtToken::getExtend();

            if ($jwtInfo && isset($jwtInfo["id"])) {
                $validToken = AdminProfileLogic::getAccessToken($jwtInfo["id"]);
                $availableTime = JwtToken::getTokenExp();

                if ($accessToken && $availableTime > 0 && $validToken === $accessToken) {
                    $user = AccountAdminModel::where("admin_id", $jwtInfo["id"])->first();
                    if ($user) {
                        $request->visitor = $user;
                        $proceed = true;
                    }
                }
            }
        } catch (\Exception $e) {
            // no authorization header
        }

        // proceed to onion core
        return $proceed
            ? $handler($request)
            : [
                "success" => false,
                "data" => "901",
                "msg" => "jwt_error",
            ];
    }
}
