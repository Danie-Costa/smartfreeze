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
use App\Services\Twilio;
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
            $recipients = Recipient::where('company_id',$device->company_id)->get();
            foreach( $recipients as  $recipient){
                Twilio::notify('+55' . preg_replace('/\D+/', '', $recipient->phone));
            }
            
        }
    }
}

