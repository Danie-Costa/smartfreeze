<?php

namespace App\Services;
use App\Classes\MercadoPago\mercadoPago;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

/**
 * Class MercadoPagoService
 * @package App\Services
 */
class MercadoPagoService
{

  protected $accessToken;
    
    /**
     * MercadoPagoService constructor.
     */


    public function __construct()
    {
      $this->accessToken = 'APP_USR-4232552277753590-083000-0242f073cd9490e64b269027a8459b36-327724043';

    }
    
    public function newPayment($title,$quantity, $unit_price, $orderIdHash){

       // Adicione as credenciais
    //   SDK::setAccessToken('TEST-4232552277753590-083000-5081b4e92803b0f824656582d170fd61-327724043');
       
       SDK::setAccessToken($this->accessToken);
       // Cria um objeto de preferência
       $preference = new Preference();

       // Cria um item na preferência
       $item = new Item();
       $item->title = $title;
       $item->quantity = $quantity;
       $item->unit_price = $unit_price;
       $preference->items = array($item);
       $preference->external_reference = $orderIdHash;
       $preference->back_urls = array(
           "success" => route('admin.dashboard'),
           "failure" => route('admin.dashboard'),
           "pending" => route('admin.dashboard')
       );
       // $preference->back_urls = array(
       //     "success" => route('SaleWebhook', [$orderIdHash]),
       //     "failure" => route('SaleWebhook', [$orderIdHash]),
       //     "pending" => route('SaleWebhook', [$orderIdHash])
       // );
       $preference->auto_return = "approved";
       $preference->save();
       
       $preferenceId = $preference->id;
       return  $preferenceId;

    }
}
