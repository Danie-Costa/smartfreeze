<?php

namespace App\Services;

class DadosEstruturadosService
{
    protected $data ;
    // https://developers.google.com/search/docs/appearance/structured-data/search-gallery?hl=pt-br
    
    public function __construct()
    {
      $this->data = [[
            "@context" => "https://schema.org",
            "@type" => "WebSite",
            "name" => env('APP_NAME', 'Aplicação'),
            "alternateName" => "IN",
            "url" => env('APP_URL', 'default_url'),
            "potentialAction" => [
            "@type" => "SearchAction",
            "target" => [
                "@type" => "EntryPoint",
                "urlTemplate" => env('APP_URL', 'default_url')."/search?q={search_term_string}"
                ],
            "query-input" => "required name=search_term_string",
            "author" => [
                "@type" => "Person",
                "name" => "Daniel Pontes Costa"
            ],
            "description" => "A " . env('APP_NAME', 'Aplicação'). ",  é uma empresa dedicada em fidelizar os seuclientes e trazer metricas de avaliação.",
            ]
        ]];
    }
    public function processarDados()
    {
        return $this->data;
    }
    public function setDescription($description){
        $this->data[0]["description"] = $description;
    }

    public function setArticle($headline, $images, $autor , $datePublished = null, $dateModified = null){
        $base = [
            "@context" => "https://schema.org",
            "@type" => "NewsArticle",
            "headline" => $headline,
            "image" => [$images],
            "datePublished" => $datePublished ?? "2024-01-05T08:00:00+08:00",
            "dateModified" =>  $dateModified ?? "2024-02-05T09:20:00+08:00",
            "author" => [
                "@type" => "Person",
                "name" => $autor,
                "url" => url()->current()
                ]
            ];
        array_push($this->data , $base);
    }
    public function setBreadcrumb($list){
        $base = [
            "@context"=> "https://schema.org",
            "@type"=> "BreadcrumbList",
            "itemListElement"=> []
        ];
        foreach( $list as $key => $item){
            array_push( $base["itemListElement"] , [
                "@type"=> "ListItem",
                "position"=> $key + 1,
                "name"=> $item["name"],
                "item"=> env('APP_URL', 'default_url').$item["url"]
            ]);
        }
        
        array_push($this->data , $base);
    }
    public function setFaq($list){
        $base = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => []
        ];
        foreach( $list as $key => $item){
            array_push( $base["mainEntity"] , [
                "@type" => "Question",
                "name" => $item["name"],
                "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => $item["text"]
                ]
            ]);
        }
        array_push($this->data , $base);
    }
    public function setRestaurant($list){
        $base = [
            "@context" => "https://schema.org",
            "@type" => "Restaurant",
            "image" => [$list["image"] ],
            "name" => $list["name"] ?? "",
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => $list["address"]["streetAddress"],
                "addressLocality" => $list["address"]["addressLocality"],
                "addressRegion" => $list["address"]["addressRegion"],
                "postalCode" => $list["address"]["postalCode"],
                "addressCountry" => $list["address"]["addressCountry"]
            ],
            "geo" => [
                "@type" => "GeoCoordinates",
                "latitude" => $list["geo"]["latitude"],
                "longitude" => $list["geo"]["longitude"]
            ],
            "url" => $list["url"],
            "telephone" => $list["telephone"],
            "servesCuisine" => $list["servesCuisine"],
            "priceRange" => $list["priceRange"],
            "openingHoursSpecification" => $list["openingHoursSpecification"]
        ];
        array_push($this->data , $base);
    }
    

    
}
