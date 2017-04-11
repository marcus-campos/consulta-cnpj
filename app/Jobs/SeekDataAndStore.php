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
    private $cnpj;
    /**
     * @var
     */
    private $acquisitionId;

    /**
     * Create a new job instance.
     *
     * @param $cnpj
     * @param $acquisitionId
     */
    public function __construct($cnpj, $acquisitionId)
    {
        $this->cnpj = $cnpj;
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
        $import->getAndStoreData($this->cnpj, $this->acquisitionId);
        sleep(5);
    }
}
