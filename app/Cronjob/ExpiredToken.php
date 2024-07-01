<?php

namespace App\Cronjob;

use Illuminate\Support\Facades\DB;

class ExpiredToken
{
    public function __invoke()
    {
        DB::table("personal_access_tokens")->where("expires_at", "<=", date("Y-m-d H:i:s"))->delete();
    }
}
