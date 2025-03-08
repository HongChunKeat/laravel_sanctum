<?php

namespace App\Http\Controllers;

# library
use App\Http\Controllers\Base;
use App\Jobs\TestQueue;
use Illuminate\Http\Request;

class Test extends Base
{
    public function testing(Request $request)
    {
        TestQueue::dispatch(['id' => 1, 'name' => 'John Doe']);
    }
}
