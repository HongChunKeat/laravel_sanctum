<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Validation](https://laravel.com/docs/validation).
- [Task scheduling](https://laravel.com/docs/scheduling).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


## Run in foreground
<ol>
    <li>Run server: <span style='color:crimson'>`php artisan serve`</span></li>
    <li>Run cronjob: <span style='color:crimson'>`php artisan schedule:work`</span></li>
    <li>Run default queue: <span style='color:crimson'>`php artisan queue:work`</span></li>
    <li>Run specific queue: <span style='color:crimson'>`php artisan queue:work --queue=redis_multithread,redis_singlethread`</span></li>
</ol>

## Run in background
<ol>
    <li>Run in background (without log): <span style='color:crimson'>`nohup command &> /dev/null &`</span></li>
    <li>Run in background (with log): <span style='color:crimson'>`nohup command &> logname.out &`</span></li>
    <li>Run <span style='color:crimson'>`lsof -i:8000`</span> to get the PID of the running server</li>
    <li>Run <span style='color:crimson'>`kill -9 PID`</span> to kill the running server</li>
    <li>Run <span style='color:crimson'>`tail logname.out -n 200`</span> to check the log</li>
</ol>

## Queue
<ol>
    <li>even if worker down the pending queue will still be saved and will be processed when the worker start</li>
    <li>by default will use default queue in <span style='color:blue'>`config/queue.php`</span></li>
    <li>set which queue to use by adding this <span style='color:blue'>`$this->onQueue('redis_multithread')`</span> in job __construct , the <span style='color:blue'>`redis_multithread`</span> is the queue name in <span style='color:blue'>`config/queue.php`</span></li>
</ol>