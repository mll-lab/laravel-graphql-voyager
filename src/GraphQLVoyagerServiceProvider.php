<?php declare(strict_types=1);

namespace MLL\GraphQLVoyager;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

use function Safe\realpath;

class GraphQLVoyagerServiceProvider extends ServiceProvider
{
    public const CONFIG_PATH = __DIR__ . '/graphql-voyager.php';
    public const VIEW_PATH = __DIR__ . '/../views';

    public function boot(ConfigRepository $config): void
    {
        $this->loadViewsFrom(self::VIEW_PATH, 'graphql-voyager');

        $this->publishes([
            self::CONFIG_PATH => $this->configPath('graphql-voyager.php'),
        ], 'graphql-voyager-config');

        $this->publishes([
            self::VIEW_PATH => $this->resourcePath('views/vendor/graphql-voyager'),
        ], 'graphql-voyager-view');

        if ($config->get('graphql-voyager.enabled', true)) {
            $this->loadRoutesFrom(__DIR__ . '/routes.php');
        }
    }

    protected function loadRoutesFrom($path): void
    {
        if (Str::contains($this->app->version(), 'Lumen')) {
            require realpath($path);

            return;
        }

        parent::loadRoutesFrom($path);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(self::CONFIG_PATH, 'graphql-voyager');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \MLL\GraphQLVoyager\DownloadAssetsCommand::class,
            ]);
        }
    }

    protected function configPath(string $path): string
    {
        return $this->app->basePath('config/' . $path);
    }

    protected function resourcePath(string $path): string
    {
        return $this->app->basePath('resources/' . $path);
    }
}
