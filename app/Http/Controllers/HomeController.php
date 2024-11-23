<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DadosEstruturadosService;

class HomeController extends Controller
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
    public function index()
    {
        $this->dadosEstruturadosService->setArticle('Artigo', 'http://127.0.0.1:8000/images/favicon.ico', 'danielpontescostas') ;
        $this->dadosEstruturadosService->setBreadcrumb([["name" =>"categoria", "url" => "/categoria"],["name" =>"page", "url" => "/categoria/page"]]);
        $this->dadosEstruturadosService->setFaq([["name" => "Titulo da pergunta","text"=>"resposta da pergunta"]]);
        $this->dadosEstruturadosService->setRestaurant(
            [
                "image"=>[
                "https://example.com/photos/1x1/photo.jpg",
                "https://example.com/photos/4x3/photo.jpg",
                "https://example.com/photos/16x9/photo.jpg"
                ],
                "name" => "Dave's Department Store",
                "address" => [
                    "@type" => "PostalAddress",
                    "streetAddress" => "1600 Saratoga Ave",
                    "addressLocality" => "San Jose",
                    "addressRegion" => "CA",
                    "postalCode" => "95129",
                    "addressCountry" => "US"
                ],
                "geo" => [
                    "@type" => "GeoCoordinates",
                    "latitude" => 37.293058,
                    "longitude" => -121.988331
                ],
                "url" => "https://www.example.com/store-locator/sl/San-Jose-Westgate-Store/1427",
                "priceRange" => "$$$",
                "telephone" => "+14088717984",
                "servesCuisine" => "Hamburgueria",
                "openingHoursSpecification" => [
                    [
                        "@type" => "OpeningHoursSpecification",
                        "dayOfWeek" => [
                            "Monday",
                            "Tuesday",
                            "Wednesday",
                            "Thursday",
                            "Friday",
                            "Saturday"
                        ],
                        "opens" => "08:00",
                        "closes" => "23:59"
                    ]
                ]
            ]
        );

        $dadosEstruturados = $this->dadosEstruturadosService->processarDados();
        return view('welcome', compact('dadosEstruturados'));
    }
}
