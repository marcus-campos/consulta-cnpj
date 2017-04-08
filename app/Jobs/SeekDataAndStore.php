<?php

namespace App\Jobs;

use App\Http\Controllers\ImportController;
use App\Models\Acquisition;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SeekDataAndStore implements ShouldQueue
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
     * @return void
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
        $import = new ImportController();
        $import->queuedImport($this->cnpjs, $this->acquisitionId);
    }
}
