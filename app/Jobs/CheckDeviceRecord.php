<?php
namespace App\Jobs;

use App\Models\Record;
use App\Models\Device;
use App\Models\Recipient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckDeviceRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $record;

    public function __construct(Record $record)
    {
        $this->record = $record;
    }

    public function handle()
    {
        $currentTime = now();
        $lastRecord = Record::where('device_id','=',$this->record->device_id)->orderBy('created_at', 'desc')->first();
        $recordTime = $lastRecord->created_at;
        
        if ($currentTime->diffInMinutes($recordTime) > 10) {
            $device = Device::where('id', $this->record->device_id)->first();
            $device->update(['status'=>'offline']);
            $recipients = Recipient::where('company_id','=',$this->record->company_id);
            foreach( $recipients as  $recipient){
                $this->notify('+55' . preg_replace('/\D+/', '', $recipient->phone));
            }
            self::dispatch($this->record)->delay(now()->addSeconds(20));
            
        }
    }
    private function notify($phone){
        $account_sid = 'AC085d0c9d8e82342d889a07db917d76f7';
        $auth_token = '6b25dacd95ac2f86398ee9ad04e0b795'; 
        $url = 'https://api.twilio.com/2010-04-01/Accounts/' . $account_sid . '/Calls.json';
        $data = [
            
            'To' => $phone,
            'From' => '+12563644743',
            'Url' => 'https://nineweb.com.br/your_twiml.xml',

        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_USERPWD, "$account_sid:$auth_token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}

