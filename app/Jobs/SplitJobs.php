<?php

namespace App\Jobs;

use App\Models\Acquisition;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SplitJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var
     */
    private $cnpjs;

    /**
     * Create a new job instance.
     *
     * @param $cnpjs
     */
    public function __construct($cnpjs)
    {
        $this->cnpjs = $cnpjs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->split();
    }

    public function split()
    {
        foreach ($this->cnpjs as $cnpj)
        {
            dispatch(new SeekDataAndStore($cnpj));
        }
    }
}
