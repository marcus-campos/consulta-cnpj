<?php

namespace App\Http\Controllers;

use App\Models\Acquisition;
use App\Models\Company;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $waiting = Acquisition::where('status', 'waiting')->sum('companies_count');
        $processing = Acquisition::where('status', 'processing')->sum('companies_count');
        $companies = Company::all()->count();

        return view('home.index', compact(
            'waiting',
            'processing',
            'companies'
        ));
    }
}
