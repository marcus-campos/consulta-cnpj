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
     * @var
     */
    private $acquisitionId;

    /**
     * Create a new job instance.
     *
     * @param $cnpjs
     * @param $acquisitionId
     */
    public function __construct($cnpjs, $acquisitionId)
    {
        $this->cnpjs = $cnpjs;
        $this->acquisitionId = $acquisitionId;
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
            dispatch(new SeekDataAndStore($cnpj, $this->acquisitionId));
        }
    }
}
