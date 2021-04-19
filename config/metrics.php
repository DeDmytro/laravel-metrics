<?php

use DeDmytro\Metrics\Widgets\MysqlConnections;
use DeDmytro\Metrics\Widgets\RequestsPerSecond;
use DeDmytro\Metrics\Widgets\UsersOnline;
use Illuminate\Auth\Middleware\Authorize;

return [
    /*
    |--------------------------------------------------------------------------
    | Url path
    |--------------------------------------------------------------------------
    */
    'path' => env('METRICS_PATH', 'metrics'),

    /*
    |--------------------------------------------------------------------------
    | Metrics Route Middleware
    |--------------------------------------------------------------------------
    | Defines list of middleware to restrict access on dev and production environment to
    */
    'middleware' => [
        'web',
       // Authorize::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Metrics Cache settings
    |--------------------------------------------------------------------------
    | To enable widget like RequestsPerSecond or OnlineUsers package should collect
    | data during short period of time and put it to cache.
    | Cache can be disabled.
    | Cache driver, can be the same as default or specific.
    | Cache expiration equals to 5 minutes.
    */
    // Define whether cache is enabled.
    'cache_enabled' => env('METRICS_CACHE_ENABLED', true),

    // Cache driver, can be the same as default or specific
    'cache_driver' => env('METRICS_CACHE_DRIVER', env('CACHE_DRIVER','redis')),

    // Defines number of seconds to remove old records
    'cache_expired' => env('METRICS_CACHE_EXPIRED', 300),

    // Defines unique cache key to store records
    'cache_key' => env('METRICS_CACHE_KEY', 'metrics-records'),

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    | List of widgets which should be displayed on dashboard
    */
    'widgets' => [
        MysqlConnections::class,
        RequestsPerSecond::class,
        UsersOnline::class,
    ],

];
