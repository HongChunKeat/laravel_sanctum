<?php

namespace App\Model\Logic;

# system lib
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
# database & logic
use App\Model\Logic\SecureLogic;
use App\Model\Logic\HelperLogic;

class AdminProfileLogic
{
    public static function newAuthKey(string $address = "")
    {
        $_response = false;
        $address = strtolower($address);

        $_response = "authentication message for login:" . HelperLogic::randomCode();
        Redis::setEx("admin_authkey:{$address}", 30, $_response);

        return $_response;
    }

    public static function verifyAuthKey(string $address = "", string $sign = "", bool $isDebug = false)
    {
        $_response = false;
        $getAuthKey = Redis::get("admin_authkey:{$address}");

        // test msg sign
        if ($isDebug) {
            $address = "0x70997970c51812dc3a010c7d01b50e0d17dc79c8";
            $getAuthKey = "Message for signing";
            $sign = "0xf3bf58813ed135d610db573848fcdc25eb3f7370e2d7cd9f6eb1855579a616b4595ba719bd7115bb207782bb2d06c743791f1b9cd15a39a603f3b995d16071731c";
        }

        if ($getAuthKey) {
            // verify the signature content
            if (SecureLogic::verifyEthSign($getAuthKey, $sign, $address)) {
                self::removeAuthKey($address);
                $_response = true;
            }
        }

        return $_response;
    }

    public static function removeAuthKey(string $address = "")
    {
        return Redis::del("admin_authkey:{$address}");
    }

    public static function newAccessToken($user)
    {
        // $newToken = Auth::login($user);
        $user->tokens()->delete();
        $newToken = $user->createToken("token", ["*"], now()->addHours(3))->plainTextToken;

        // 3 hours
        Redis::setEx("admin_accessToken:{$user['admin_id']}", 10800, $newToken);

        return $newToken;
    }

    public static function getAccessToken(string $admin_id = "")
    {
        return Redis::get("admin_accessToken:{$admin_id}");
    }

    public static function logout($user)
    {
        // Auth::logout();
        $user->tokens()->delete();
        return Redis::del("admin_accessToken:{$user['admin_id']}");
    }
}
