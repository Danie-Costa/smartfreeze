<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Plan;
use App\Models\State;
use App\Models\City;
use App\Models\Segment;
use App\Models\User;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(auth()->user()->rule == 'customer'){
        
            $companies = Company::orderBy("id", "ASC");
    
            if ($param = $request->search) {
                $companies->where("title", "LIKE", "%{$param}%");
            }
            $companies->paginate(20);
            $companies = $companies->get();
            $segments = Segment::get();
            return view('customer.dashboard.index', compact("companies",'segments'));
        }
        return view('home');
    }
}
