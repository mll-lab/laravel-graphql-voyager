<?php declare(strict_types=1);

/** @var ConfigRepository $config */

use Illuminate\Contracts\Config\Repository as ConfigRepository;

$config = app(ConfigRepository::class);
assert($config instanceof ConfigRepository);

$routeConfig = $config->get('graphql-voyager.route');
if (is_array($routeConfig)) {
    /**
     * @var array{
     *   name?: string|null,
     *   middleware?: array<string>|null,
     *   prefix?: string|null,
     *   domain?: string|null,
     *   uri?: string|null,
     * } $routeConfig
     */

    /**
     * Not using assert() since only one of those classes is actually present at runtime.
     *
     * @var \Illuminate\Contracts\Routing\Registrar|\Laravel\Lumen\Routing\Router $router
     */
    $router = app('router');

    $actions = [
        'as' => $routeConfig['name'] ?? 'graphql-voyager',
        'uses' => \MLL\GraphQLVoyager\GraphQLVoyagerController::class,
    ];

    if (isset($routeConfig['middleware'])) {
        $actions['middleware'] = $routeConfig['middleware'];
    }

    if (isset($routeConfig['prefix'])) {
        $actions['prefix'] = $routeConfig['prefix'];
    }

    if (isset($routeConfig['domain'])) {
        $actions['domain'] = $routeConfig['domain'];
    }

    $router->get(
        $routeConfig['uri'] ?? '/graphql-voyager',
        $actions
    );
}
