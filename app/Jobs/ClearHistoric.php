<?php

namespace App\Jobs;
use Log;


class ClearHistoric extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
                $this->queue = $data['queue'];

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
              Log::info('Hello! Queue job '.$this->queue.' is run at start time - '.microtime(true));

    }
}
