<?php declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Route configuration
    |--------------------------------------------------------------------------
    |
    | Set the URI at which the GraphQL Voyager can be viewed
    | and any additional configuration for the route.
    |
    */

    'route' => [
        'uri' => '/graphql-voyager',
        'name' => 'graphql-voyager',
        // 'middleware' => ['web']
        // 'prefix' => '',
        // 'domain' => 'graphql.' . env('APP_DOMAIN', 'localhost'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Default GraphQL endpoint
    |--------------------------------------------------------------------------
    |
    | The default endpoint that GraphQL Voyager fetches introspection from.
    | It assumes you are running GraphQL on the same domain
    | as GraphQL Voyager, but can be set to any URL.
    | If set to `null`, no introspection will be preloaded.
    |
    */

    'endpoint' => '/graphql',

    /*
    |--------------------------------------------------------------------------
    | Control Voyager availability
    |--------------------------------------------------------------------------
    |
    | Control if GraphQL Voyager is accessible at all.
    | This allows you to disable it in certain environments,
    | for example you might not want it active in production.
    |
    */

    'enabled' => env('GRAPHQL_VOYAGER_ENABLED', true),
];
