<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function show($id)
    {
        $company = Company::find($id);

        $company = json_decode($company->data, true);

        return view('company.index', compact('company'));
    }

    public function delete($ids)
    {
        $ids = json_decode($ids);
        Company::destroy($ids);

        return redirect()->to('search');
    }
}
