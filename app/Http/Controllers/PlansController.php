<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Plan;

class PlansController extends Controller
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
        $plans = Plan::orderBy('id', 'ASC');

        if ($param = $request->search) {
            $plans->where('title', 'LIKE', "%{$param}%");
        }

        $plans->paginate(20);
        $plans = $plans->get();
        
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        $plan = new Plan();
        $route = 'plans';
        $title = 'Novo Plano';
        $data = $plan;
        return view('admin.automatic.create', compact('data','route','title'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Plan::create($request->all());
            DB::commit();
            return redirect()->route('admin.plans.index')->with('success', 'Item cadastrado com sucesso!');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        $route = 'plans';
        $title = 'Ver Plano';
        $data = $plan;
        return view('admin.automatic.show', compact('data','route','title'));
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $route = 'plans';
        $title = 'Editar Plano';
        $data = $plan;
        return view('admin.automatic.edit', compact('data','route','title'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $plan = Plan::findOrFail($id);
            $plan->update($request->all());
            DB::commit();
            return redirect()->route('admin.plans.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return redirect()->route('admin.plans.index');
    }
}
