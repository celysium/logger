<?php
return [
    'logger' => [
        'driver'   => 'mongodb',
        'host'     => env('DB_MONGO_HOST', 'localhost'),
        'port'     => env('DB_MONGO_PORT', '27017'),
        'database' => 'logger',
        'username' => env('DB_MONGO_USERNAME'),
        'password' => env('DB_MONGO_PASSWORD'),
        'options'  => [
            'database' => env('DB_AUTHENTICATION_DATABASE', 'admin')
        ],
    ],
];
