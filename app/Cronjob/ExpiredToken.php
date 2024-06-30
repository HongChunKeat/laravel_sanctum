<?php

namespace App\Cronjob;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExpiredToken
{
    public function __invoke()
    {
        DB::table("sw_personal_access_tokens")->where("expires_at", "<=", date("Y-m-d H:i:s"))->delete();
        Log::info(date("Y-m-d H:i:s"));
    }
}
