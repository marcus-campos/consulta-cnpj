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
    private $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cnpjs, $id)
    {
        $this->cnpjs = $cnpjs;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $import = new ImportController();

        $this->changeStatus('processing');

        $import->queuedImport($this->cnpjs);

        $this->changeStatus('processed');
    }

    /**
     * @param $status
     */
    public function changeStatus($status)
    {
        $acquisition = Acquisition::find($this->id);
        $acquisition->status = $status;
        $acquisition->save();
    }
}
