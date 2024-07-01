<?php

# system lib
use Illuminate\Support\Facades\Schedule;
# cronjob class
use App\Cronjob\ExpiredToken;
use App\Cronjob\Test;

/**
 * https://laravel.com/docs/11.x/scheduling
 * run in background: php artisan schedule:work > /dev/null 2>&1 &
 */

// Schedule::call(new Test)->everyFifteenSeconds();
Schedule::call(new ExpiredToken)->cron("* * * * *");
