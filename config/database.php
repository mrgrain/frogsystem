<?php

return [
    'connection' => getenv('DB_TYPE') ?: 'mysql',

    'mysql' => [
        'driver' => 'mysql',
        'database' => getenv('DB_NAME'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'host' => getenv('DB_HOST') ?: 'localhost',
        'prefix' => getenv('DB_PREFIX') ?: 'fs2_',
        'charset' => getenv('DB_CHARSET') ?: 'utf8',
        'collation' => getenv('DB_COLLATION') ?: 'utf8_unicode_ci',
    ]
];
