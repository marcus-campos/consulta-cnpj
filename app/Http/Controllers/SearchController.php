<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function index()
    {
        $searchValue = 'todos os registros';
        $companies = Company::orderBy('updated_at', 'desc')->paginate(15);
        return view('search.index', compact(
            'companies',
            'searchValue'
        ));
    }

    public function search()
    {
        $searchValue = Input::get('search-txt');
        $companies = Company::where('name', 'like', '%'.Input::get('search-txt') .'%')->orWhere('cnpj', 'like', '%'.Input::get('search-txt') .'%')->paginate(15);

        return view(
            'search.result',
            compact('companies', 'searchValue')
        );
    }
}
