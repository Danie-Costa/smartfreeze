<?php 

return [
    'user_permissions' => [
        'admin' => [
            'home',
            'admin.dashboard',
            'users.index',
            'users.create',
            'admin.busca-cidades',
            
            'admin.plans.index',
            'admin.plans.create',
            'admin.plans.store',
            'admin.plans.edit',
            'admin.plans.delete',
            'admin.plans.show',
            
            'admin.companies.index',
            'admin.companies.create',
            'admin.companies.store',
            'admin.companies.edit',
            'admin.companies.delete',
            'admin.companies.show',
            
        ],
        
    ],
    'links'=>[
        'admin' => [
            'admin.dashboard' => [
                'title'=>'Home',
                'icon'=>'fa fa-home',
                'mobile'=> true,
            ],   
            'admin.companies.index' => [
                'title'=>'Empresas',
                'icon'=>'fa fa-building ',
                'mobile'=> true,
            ],
            'admin.plans.index' => [
                'title'=>'Planos',
                'icon'=>'fa fa-credit-card',
                'mobile'=> true,
            ],
            
        ],
        
    ]
];


?>