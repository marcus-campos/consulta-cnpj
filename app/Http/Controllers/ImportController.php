<?php

namespace App\Http\Controllers;

use App\Jobs\SeekDataAndStore;
use App\Models\Acquisition;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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
    public function queuedImport($value)
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

        $this->getAndStoreData($cnpjs);
        return $cnpjs;
    }
    /**
     * @param $cnpjs
     */
    private function getAndStoreData($cnpjs)
    {
        $client = new Client();

        foreach ($cnpjs as $cnpj) {
            $res = $client->request('GET', $this->baseUrl . $cnpj);
            $this->storeData($cnpj, $res);
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
        $company = Company::firstOrCreate(['cnpj' => $cnpj]);
        $company->name = $values['nome'];
        $company->data = $body;
        $company->save();
    }
}
