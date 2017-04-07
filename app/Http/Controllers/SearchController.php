<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    public function search()
    {
        $searchValue = Input::get('search-txt');
        $companies = Company::where('name', 'like', '%'.Input::get('search-txt') .'%')->orWhere('cnpj', 'like', '%'.Input::get('search-txt') .'%')->get();

        return view(
            'search.result',
            compact('companies', 'searchValue')
        );
    }
}
