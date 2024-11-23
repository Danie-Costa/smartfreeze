<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Device;

class DevicesController extends Controller
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
        $devices = Device::orderBy("id", "ASC");

        if ($param = $request->search) {
            $devices->where("title", "LIKE", "%{$param}%");
        }

        $devices->paginate(20);
        $devices = $devices->get();
        
        return view("admin.devices.index", compact("devices"));
    }

    public function create()
    {
        $device = new Device();
        $route = "devices";
        $title = "Novo device";
        $data = $device;
        return view("admin.automatic.create", compact("data","route","title"));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request['status'] = 'offline';
            $request['company_id'] = GetMayCompanyId();
            $request['token'] = trim($request['token']);
            if($request['token']==''){
                $request['token'] =  uniqid(trim(date('HisYmd')));
            }
            
            $request['slug'] = toUrl(trim($request['title']));
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $upload = uploadImage($request->file('image'), $request['slug'] . '-' . uniqid(date('HisYmd')), 'devices');
                if (!$upload) {
                    return redirect()->back()->with('error', 'Falha ao fazer upload')->withInput();
                }
                $request['cover'] = $upload;
            }
            Device::create($request->all());
            
            
            DB::commit();
            return redirect()->route("admin.devices.index")->with("success", "Item cadastrado com sucesso!");
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $device = Device::findOrFail($id);
        $route = "devices";
        $title = "Ver device";
        $data = $device;
        return view("admin.devices.show", compact("data","route","title"));
    }

    public function edit($id)
    {
        $device = Device::findOrFail($id);
        $route = "devices";
        $title = "Editar device";
        $data = $device;
        return view("admin.automatic.edit", compact("data","route","title"));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $device = Device::findOrFail($id);
            $device->update($request->all());
            DB::commit();
            return redirect()->route("admin.devices.index");
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();
        return redirect()->route("admin.devices.index");
    }
}
