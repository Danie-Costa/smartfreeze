<?php

namespace App\Services;

/**
 * Class Twilio
 * @package App\Services
 */
class Twilio
{
    /**
     * Twilio constructor.
     */
    public function __construct()
    {

    }
    
    public function notify($phone){

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
