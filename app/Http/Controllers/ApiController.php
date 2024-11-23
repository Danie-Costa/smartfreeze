<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DadosEstruturadosService;


use App\Models\Device;
use App\Models\Record;
use App\Jobs\CheckDeviceRecord;

class ApiController extends Controller
{
    protected $dadosEstruturadosService;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DadosEstruturadosService $dadosEstruturadosService)
    {
        $this->dadosEstruturadosService = $dadosEstruturadosService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function notify($token, Request $request)
    {
        $device = Device::where('token', $token)->first();
        $device->update(['status'=>'online']);
        
        if ($device) {
            $record = Record::create([
                'company_id' => $device->company_id,
                'device_id' => $device->id,
                'description' => 'Ativo'
            ]);
            CheckDeviceRecord::dispatch($record)->delay(now()->addMinutes(15));
            return response()->json([
                'status' => 'success',
                'message' => 'Dispositivo encontrado e registro criado.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Dispositivo não encontrado.'
            ], 404);
        }
    }
}
