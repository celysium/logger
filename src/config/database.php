<?php
return [
    'database' => [
        'logger_mongo' => [
            'driver'   => 'mongodb',
            'host'     => env('DB_MONGO_HOST', 'localhost'),
            'port'     => env('DB_MONGO_PORT', '27017'),
            'database' => env('DB_MONGO_DATABASE', 'logger'),
            'username' => env('DB_MONGO_USERNAME'),
            'password' => env('DB_MONGO_PASSWORD'),
            'options'  => [
                'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
            ],
        ],
    ],
];
