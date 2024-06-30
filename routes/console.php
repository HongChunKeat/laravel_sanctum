<?php

# system lib
use Illuminate\Support\Facades\Schedule;
# cronjob class
use App\Cronjob\ExpiredToken;

# https://laravel.com/docs/11.x/scheduling
// crontab -e then put php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1

Schedule::call(new ExpiredToken)->cron("* * * * *");
