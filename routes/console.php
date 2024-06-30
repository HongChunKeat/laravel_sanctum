<?php

# system lib
use Illuminate\Support\Facades\Schedule;
# cronjob class
use App\Cronjob\ExpiredToken;

# https://laravel.com/docs/11.x/scheduling

Schedule::call(new ExpiredToken)->cron("* * * * *");
