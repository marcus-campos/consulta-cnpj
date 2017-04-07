<?php

namespace App\Http\Controllers;

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
    public function import(Request $request)
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

        $this->getAndStoreData($cnpjs);
        return $cnpjs;
    }

    /**
     * @param $cnpjs
     */
    public function getAndStoreData($cnpjs)
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
