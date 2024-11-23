<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

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
        if(auth()->user()->rule == 'manager'){
            
            $devices = Device::orderBy("id", "ASC");

            if ($param = $request->search) {
                $devices->where("title", "LIKE", "%{$param}%");
            }

            $devices->paginate(20);
            $devices = $devices->get();
            
            return view("admin.devices.index", compact("devices"));
        }
        return view('home');
    }
}
