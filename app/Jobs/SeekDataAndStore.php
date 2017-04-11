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
     * Create a new job instance.
     *
     * @param $cnpj
     */
    public function __construct($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $acquisitionId = Acquisition::create(['companies_count' => 1])->id;
        $import = new ImportController();
        $import->getAndStoreData($this->cnpj, $acquisitionId);
        sleep(5);
    }
}
