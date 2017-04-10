<?php

namespace App\Http\Controllers;

use App\Jobs\SeekDataAndStore;
use App\Jobs\SplitJobs;
use App\Models\Acquisition;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Mockery\Exception;

class ImportController extends Controller
{
    protected $baseUrl = "https://www.receitaws.com.br/v1/cnpj/";

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('import.index');
    }


    /**
     * @return mixed
     */
    public function import()
    {
        $cnpjs = array_filter(
            explode(
                ';',
                str_replace(
                    ' ',
                    '',
                    Input::get('cnpjs')
                )
            )
        );

        if(env('QUEUE_ENABLE', 'false') == 'true') {
            dispatch(new SplitJobs($cnpjs));
            return Input::get('cnpjs');
        }
        else {

            foreach ($cnpjs as $cnpj)
            {
                $acquisitionId = Acquisition::create(['companies_count' => 1])->id;
                $this->getAndStoreData($cnpj, $acquisitionId);
            }
        }
    }

    /**
     * @param $cnpj
     * @param $acquisitionId
     */
    public function getAndStoreData($cnpj, $acquisitionId)
    {
        $client = new Client();

        $this->changeStatus($acquisitionId, 'processing');

        try {
            $res = $client->request('GET', $this->baseUrl . $cnpj);
            $this->storeData($cnpj, $res);

            $this->changeStatus($acquisitionId, 'processed');
        }
        catch (Exception $ex) {
            $this->changeStatus($acquisitionId, 'waiting');
        }
        finally {
            $this->changeStatus($acquisitionId, 'processed');
        }
    }

    /**
     * @param $cnpj
     * @param $res
     */
    private function storeData($cnpj, $res)
    {
        $body = $res->getBody()->getContents();
        $values = json_decode($body, true);

        if($values['status'] != 'ERROR') {
            $company = Company::firstOrCreate(['cnpj' => $cnpj]);
            $company->name = $values['nome'];
            $company->data = $body;
            $company->save();
        }
    }

    /**
     * @param $id
     * @param $status
     */
    public function changeStatus($id, $status)
    {
        $acquisition = Acquisition::find($id);
        $acquisition->status = $status;
        $acquisition->save();
    }
}
