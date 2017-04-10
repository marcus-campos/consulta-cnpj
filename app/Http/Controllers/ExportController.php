<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * @param $ids
     * @param $ext
     */
    public function export($ids, $ext)
    {
        $ids = json_decode($ids, true);

        Excel::create('ExportCNPJs', function($excel) use (&$ids){
            foreach ($ids as $id) {
                $company = Company::find($id);

                $excel->sheet('CNPJ - '. $company['cnpj'], function ($sheet) use(&$company) {
                    $company = json_decode($company->data, true);
                    $sheet->loadView('company.excel', ['company' => $company]);
                });
            }
        })->download($ext);
    }
}
