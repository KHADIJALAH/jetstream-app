<?php

use Illuminate\Support\Str;

return [
    'default' => env('CACHE_DRIVER', 'database'),

    'stores' => [
        'database' => [
            'driver' => 'database',
            'table' => env('DB_CACHE_TABLE', 'cache'),
            'connection' => env('DB_CACHE_CONNECTION', null), // Uses your default DB connection if not specified
            'lock_connection' => env('DB_CACHE_LOCK_CONNECTION', null), // Optional: Separate connection for locks
            'lock_table' => env('DB_CACHE_LOCK_TABLE', 'cache_locks'), // Separate table for cache locks
            'lock_lottery' => 0.1, // Probability for cleaning up stale locks (adjust as needed)
        ],

        // Keep other store configurations for potential future use
        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'connection' => env('DB_CACHE_CONNECTION', null), // Valeur par défaut explicite
            'table' => 'cache_entries', // Nom de table plus explicite
            'lock_connection' => env('DB_CACHE_LOCK_CONNECTION', null),
            'lock_lottery' => 0.1, // Ajout recommandé pour la gestion des verrous
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
    'driver' => 'memcached',
    'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
    'sasl' => [
        env('MEMCACHED_USERNAME'),
        env('MEMCACHED_PASSWORD'),
    ],
    'options' => [
        // Memcached::OPT_CONNECT_TIMEOUT => 2000,
    ],
    'servers' => [
        [
            'host' => env('MEMCACHED_HOST', '127.0.0.1'),
            'port' => env('MEMCACHED_PORT', 11211),
            'weight' => 100,
        ],
    ],
],

'redis' => [
    'driver' => 'redis',
    'connection' => env('REDIS_CACHE_CONNECTION', 'cache'),
],

        // ... autres drivers ...

    ],

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel')) . '_db_cache'),
];