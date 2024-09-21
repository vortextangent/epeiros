<?php

return [
    'system' => [
        'database' => [
            'dsn'      => 'mysql:host=<hostname>;dbname=<schema>',
            'user'     => '<username>',
            'password' => '<password>',
            'options'  => [
                \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
            ],
        ],
    ],
];