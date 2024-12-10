<?php

return [
    // Paths configuration for migrations and seeds
        'paths' => [
                'migrations' => 'db/migrations', // Directory for migration files
                'seeds' => 'db/seeds', // Directory for seed files
        ],
    // Environments configuration
    // TODO: Change the values of the following keys to match your database configuration
        'environments' => [
                'default_migration_table' => 'phinxlog', // Default table to log migrations
                'default_environment' => 'development', // Default environment
                'development' => [
                        'adapter' => 'mysql', // Database adapter
                        'host' => 'localhost', // Database host
                        'name' => 'database-name', // Database name
                        'user' => 'user', // Database user
                        'pass' => 'password', // Database password
                        'port' => '3306', // Database port
                        'charset' => 'utf8mb4', // Database charset
                ],
        ],
];
