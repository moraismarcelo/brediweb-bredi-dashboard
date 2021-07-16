<?php

return [
    'name'      => 'BrediDashboard',
    'prefix'    => 'controle',
    'default'   => 'color-admin',
    'templates' => [
        'color-admin' => [
            'name' => 'bredicoloradmin',
        ],
        'admin-lte'   => [
            'name' => 'brediadminlte',
        ],
    ],
    'superadmin' => [
        'contato@bredi.com.br'
    ],
    'menu' => [

    ],
    'user' => [
        'password_validation' => 'required|min:6',
        'imagem' => [
            'input_file' => 'imagem',
            'destino' => 'user/',
            'resolucao' => ['m' => ['h' => 500, 'w' => 500], 'p' => ['h' => 150, 'w' => 150]],
            'preencher' =>['p'],
        ],
    ],
    'background_image' => [
        'input_file' => 'background_image',
        'destino' => 'background_image/',
        'resolucao' => ['h' => 1280, 'w' => 1280]
    ],
    'logo' => [
        'input_file' => 'logo',
        'destino' => 'company/',
        'resolucao' => ['g' => ['h' => 30, 'w' => 100], 'p' => ['h' => 200, 'w' => 200]]
    ],
];
