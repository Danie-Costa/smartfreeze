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
            
            'admin.devices.index',
            'admin.devices.create',
            'admin.devices.store',
            'admin.devices.edit',
            'admin.devices.delete',
            'admin.devices.show',
            
        ],
        'manager' => [
            'home',
            'admin.dashboard',
            'admin.companies.show',
            'admin.devices.index',
            'admin.devices.show',

            'admin.recipients.index',
            'admin.recipients.create',
            'admin.recipients.store',
            'admin.recipients.edit',
            'admin.recipients.delete',
            'admin.recipients.show',
            
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
            'admin.devices.index' => [
                'title'=>'Dispositivos',
                'icon'=>'fa fa-clone',
                'mobile'=> true,
            ],
            
        ],
        'manager' => [
            'admin.dashboard' => [
                'title'=>'Home',
                'icon'=>'fa fa-home',
                'mobile'=> true,
            ], 
            'admin.recipients.index' => [
                'title'=>'Usuarios',
                'icon'=>'fa fa-users',
                'mobile'=> true,
            ],   
        ],
        
    ]
];


?>