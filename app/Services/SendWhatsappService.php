<?php

namespace App\Services;

/**
 * Class SendWhatsappService
 * @package App\Services
 */
class SendWhatsappService
{
    /**
     * SendWhatsappService constructor.
     */
    private $url = 'https://v5.chatpro.com.br/chatpro-27k265etcl/api/v1/send_message';
    private $response;

    public function __construct()
    {

    }
    
    public function send($number , $message){

        $ch = curl_init($this->url);

        // Configura as opções do cURL para a requisição POST
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"number":"'.$number.'","message":"'.$message.'"}');

        // Configura os headers
        $headers = [
            'accept: application/json',
            'content-type: application/json',
            "Authorization: 3d018f18c02d5e13a65bbb4e562e4318"
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Executa a requisição
        $response = curl_exec($ch);

        // Fecha o cURL para liberar recursos
        curl_close($ch);

        // Verifica se houve erro na requisição
        if ($response === false) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            // Exibe a resposta
            echo $response;
        }
    
        return 'invalid data';
    }
}
