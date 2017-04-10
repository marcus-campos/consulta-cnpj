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
            $companies = Company::whereIn('id', $ids)->get();

            $excel->sheet('CNPJs', function ($sheet) use(&$companies) {
                $sheet->loadView('company.excel', ['companies' => $companies]);
            });

        })->download($ext);
    }
}
