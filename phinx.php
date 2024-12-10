<?php

return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'testdb',
            'user' => 'kiet',
            'pass' => 'password',
            'port' => '3306',
            'charset' => 'utf8mb4',
        ],
    ],
];
