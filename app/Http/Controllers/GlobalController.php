<?php

namespace App\Http\Controllers;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
# database & logic
use App\Model\Logic\HelperLogic;

class GlobalController extends Base
{
    # [validation-rule]
    protected $rule = [
        "password" => "required",
        "key" => "max:150",
        "value" => "",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "password",
        "key",
        "value",
    ];

    public function redisFlush(Request $request)
    {
        # [validation]
        $this->validation($request->input(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->input(), $this->patternInputs);

        # [checking]
        $this->checking($cleanVars);

        # [proceed]
        if (!count($this->error)) {
            # [process]
            if (count($cleanVars) > 0) {
                //clear all key
                Redis::flushDB();

                # [result]
                $this->response = [
                    "success" => true,
                ];
            }
        }

        # [standard output]
        return $this->output();
    }

    public function redis(Request $request)
    {
        $this->rule["key"] .= "|required";

        # [validation]
        $this->validation($request->input(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->input(), $this->patternInputs);

        # [checking]
        $this->checking($cleanVars);

        # [proceed]
        if (!count($this->error)) {
            # [process]
            if (count($cleanVars) > 0) {
                //set redis
                if (isset($cleanVars["value"])) {
                    Redis::set($cleanVars["key"], $cleanVars["value"]);
                }

                # [result]
                $this->response = [
                    "success" => true,
                    "data" => Redis::get($cleanVars["key"]),
                ];
            }
        }

        # [standard output]
        return $this->output();
    }

    private function checking(array $params = [])
    {
        # [condition]
        // check password
        if (isset($params["password"])) {
            if ($params["password"] != env("COMMON_PASSWORD")) {
                $this->error[] = "password:invalid";
            }
        }
    }
}
