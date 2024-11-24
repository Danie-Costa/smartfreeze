<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Plan;
use App\Models\State;
use App\Models\City;
use App\Models\Segment;
use App\Models\User;
use App\Models\CustomerCompany;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class CompaniesController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        
        $companies = Company::orderBy("id", "ASC");
        if ($param = $request->search) {
            $companies->where("name", "LIKE", "%{$param}%");
        }
        $companies->paginate(20);
        $companies = $companies->get();      
        return view("admin.companies.index", compact("companies"));
    }

    public function create()
    {
        $company = new Company();
        $route = "companies";
        $title = "Novo company";
        $data = $company;
        $planList = array();
        foreach (Plan::get() as $planl) {
            $planList += [$planl->id => $planl->title];
        }
        $states = State::pluck('title','id');
        $cities = [''=>'Primeiro selecione um Estado'];
        return view("admin.automatic.create", compact("data","route","title","planList","states","cities"));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request['slug'] = toUrl($request['name']);
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $upload = uploadImage($request->file('image'), $request['slug'] . '-' . uniqid(date('HisYmd')), 'company');
                if (!$upload) {
                    return redirect()->back()->with('error', 'Falha ao fazer upload')->withInput();
                }
                $request['logo'] = $upload;
            }
            $plan = Plan::find($request->plan_id);
            $request["initial_date"] = Carbon::now()->format('Y-m-d');
            $request["final_date"] = $request["initial_date"];
            $dataCarbon = Carbon::parse($request->final_date);
             switch ($plan->type) {
                case 'day':
                    $request['final_date'] = $dataCarbon->addDays($plan->amount);
                    break;
                case 'month':
                    $request['final_date'] = $dataCarbon->addMonths($plan->amount);
                    break;
                case 'year':
                    $request['final_date'] = $dataCarbon->addYears($plan->amount);
                    break;
            }
            $request['corporate_email'] = $request['email'];
            
            $company = company::create($request->all());
            User::create([
                'rule' => 'manager',
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_id' => $company->id,
            ]);
            DB::commit();
            return redirect()->route('admin.companies.index')->with('success', 'Item cadastrado com sucesso!');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        $route = "companies";
        $title = "Ver company";
        $data = $company;
        $planList = array();
        foreach (Plan::get() as $planl) {
            $planList += [$planl->id => $planl->title];
        }
        $states = State::pluck('title','id');
        $cities = City::where('state_id', $company->state_id)->pluck('title','id');
        return view("admin.automatic.show", compact("data","route","title","planList","states","cities"));
    }
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $route = "companies";
        $title = "Editar company";
        $data = $company;
        $planList = array();
        foreach (Plan::get() as $planl) {
            $planList += [$planl->id => $planl->title];
        }
        $states = State::pluck('title','id');
        $cities = City::where('state_id', $company->state_id)->pluck('title','id');
        return view("admin.automatic.edit", compact("data","route","title","planList","states","cities"));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $company = company::findOrFail($id);
            $request['slug'] = toUrl($request['name']);
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $upload = uploadImage($request->file('image'), $request['slug'] . '-' . uniqid(date('HisYmd')), 'company');
                if (!$upload) {
                    return redirect()->back()->with('error', 'Falha ao fazer upload')->withInput();
                }
                $request['logo'] = $upload;
                Storage::disk('public')->delete($company->cover);

            }
            $user = $company->user()->first();
            if($request->password  && $request->password != ''){
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
            $request['corporate_email'] = $request['email'];
            $company->update($request->all());
            DB::commit();
            return redirect()->route('admin.companies.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route("admin.companies.index");
    }
}
