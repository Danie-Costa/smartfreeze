<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DadosEstruturadosService;


use App\Models\Device;
use App\Models\Record;
use App\Models\Recipient;
use App\Jobs\CheckDeviceRecord;
use App\Services\Twilio;

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
        if($device->status == 'offline'){
            $device->update(['status'=>'online']);
            $recipients = Recipient::where('company_id',$device->company_id)->get();
            foreach( $recipients as  $recipient){
                Twilio::notify('+55' . preg_replace('/\D+/', '', $recipient->phone));
            }
            
        }
        
        
        if ($device) {
            $record = Record::create([
                'company_id' => $device->company_id,
                'device_id' => $device->id,
                'description' => 'Ativo'
            ]);
            // CheckDeviceRecord::dispatch($record)->delay(now()->addMinutes(15));
            // CheckDeviceRecord::dispatch($record)->delay(now()->addMinutes(20));
            CheckDeviceRecord::dispatch($record)->delay(now()->addSeconds(10));
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
