<?php

namespace App\Cronjob;

use Illuminate\Support\Facades\Log;

class Test
{
    public function __invoke()
    {
        Log::info("test:" . date("Y-m-d H:i:s"));
    }
}
