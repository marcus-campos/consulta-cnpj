<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function index()
    {
        $paginate = Input::get('paginate');

        $searchValue = 'todos os registros';
        $companies = Company::orderBy('updated_at', 'desc')->paginate($paginate);
        return view('search.index', compact(
            'companies',
            'searchValue'
        ));
    }

    public function search()
    {
        $searchValue = Input::get('search-txt');
        $paginate = Input::get('paginate');

        $companies = Company::where('name', 'like', '%'. $searchValue .'%')->orWhere('cnpj', 'like', '%'. $searchValue .'%')->paginate($paginate);

        return view(
            'search.result',
            compact('companies', 'searchValue')
        );
    }
}
