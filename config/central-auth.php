<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable / Disable
    |--------------------------------------------------------------------------
    */
    'enabled' => env('CENTRAL_AUTH_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Shared DB mode
    |--------------------------------------------------------------------------
    | true  => use a dedicated connection for central auth tables
    | false => use the app default DB connection
    */
    'shared_db' => env('CENTRAL_AUTH_SHARED_DB', true),

    /*
    |--------------------------------------------------------------------------
    | Connection name (used when shared_db = true)
    |--------------------------------------------------------------------------
    */
    'connection' => env('CENTRAL_AUTH_CONNECTION', 'mysql_auth'),

    /*
    |--------------------------------------------------------------------------
    | Tables
    |--------------------------------------------------------------------------
    */
    'tables' => [
        'users' => env('CENTRAL_AUTH_USERS_TABLE', 'users'),
        'roles' => env('CENTRAL_AUTH_ROLES_TABLE', 'roles'),
        'pivot' => env('CENTRAL_AUTH_PIVOT_TABLE', 'role_user'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Pivot keys
    |--------------------------------------------------------------------------
    */
    'pivot_keys' => [
        'user_fk' => env('CENTRAL_AUTH_PIVOT_USER_FK', 'user_id'),
        'role_fk' => env('CENTRAL_AUTH_PIVOT_ROLE_FK', 'role_id'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Role column used for checks (name/slug)
    |--------------------------------------------------------------------------
    */
    'role_column' => env('CENTRAL_AUTH_ROLE_COLUMN', 'name'),

    /*
    |--------------------------------------------------------------------------
    | Caching (optional)
    |--------------------------------------------------------------------------
    */
    'cache' => [
        'enabled' => env('CENTRAL_AUTH_CACHE', true),
        'ttl'     => (int) env('CENTRAL_AUTH_CACHE_TTL', 300),
        'prefix'  => env('CENTRAL_AUTH_CACHE_PREFIX', 'central_auth'),
    ],
];
