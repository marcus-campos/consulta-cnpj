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
            if(count($cnpjs) < 100)
                dispatch(new SplitJobs($cnpjs));
            else
            {
                $numberOfCNPJs = count($cnpjs);
                $lastOffSet = 0;
                $substracted = 0;
                $lenght = 100;

                while ($numberOfCNPJs > 0)
                {
                    $arraySplice = array_slice($cnpjs, $lastOffSet, $lenght);

                    dispatch(new SplitJobs($arraySplice));

                    $numberOfCNPJs = $numberOfCNPJs - $lenght;
                    $lastOffSet = $lenght + 1;

                    if($numberOfCNPJs > 100)
                        $lenght = $lenght + $lenght + 1;
                    else
                        $lenght = $lenght + $numberOfCNPJs;
                }
            }

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
