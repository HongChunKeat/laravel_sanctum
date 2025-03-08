<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class TestQueue implements ShouldQueue
{
    use Queueable;

    protected $data;

    /**
     * Create a new job instance and data pass in from here
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info($this->data);
    }
}
