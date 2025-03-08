<?php

# system lib
use Illuminate\Support\Facades\Schedule;
# cronjob class
use App\Cronjob\ExpiredToken;
use App\Cronjob\Test;

// Schedule::call(new Test)->everyFifteenSeconds();
Schedule::call(new ExpiredToken)->cron("* * * * *");
