<?php

namespace App\Http\Controllers;

use App\Jobs\SeekDataAndStore;
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
     * @return array|ø
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
            $acquisitionId = Acquisition::create(['companies_count' => count($cnpjs)]);
            dispatch(new SeekDataAndStore(Input::get('cnpjs'),  $acquisitionId));
            return Input::get('cnpjs');
        }
        else {

            $this->getAndStoreData($cnpjs);
            return Input::get('cnpjs');
        }
    }


    /**
     * @return array|ø
     */
    public function queuedImport($value, $acquisitionId)
    {
        $cnpjs = array_filter(
            explode(
                ';',
                str_replace(
                    ' ',
                    '',
                    $value
                )
            )
        );

        $this->getAndStoreData($cnpjs, $acquisitionId);
        return $cnpjs;
    }
    /**
     * @param $cnpjs
     */
    private function getAndStoreData($cnpjs, $acquisitionId)
    {
        $client = new Client();

        $this->changeStatus($acquisitionId, 'processing');

        try {
            foreach ($cnpjs as $cnpj) {
                $res = $client->request('GET', $this->baseUrl . $cnpj);
                $this->storeData($cnpj, $res);
            }

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
