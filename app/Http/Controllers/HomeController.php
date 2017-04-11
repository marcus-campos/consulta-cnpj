<?php

namespace App\Http\Controllers;

use App\Models\Acquisition;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $waiting = DB::table('jobs')->count();
        $processing = Acquisition::where('status', 'processing')->sum('companies_count');
        $companies = Company::all()->count();

        return view('home.index', compact(
            'waiting',
            'processing',
            'companies'
        ));
    }
}
