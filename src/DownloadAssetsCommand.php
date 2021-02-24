<?php

declare(strict_types=1);

namespace MLL\GraphQLVoyager;

use Illuminate\Console\Command;
use function Safe\file_get_contents;
use function Safe\file_put_contents;
use function Safe\mkdir;

class DownloadAssetsCommand extends Command
{
    const REACT_PATH_LOCAL = 'vendor/graphql-voyager/react.js';
    const REACT_PATH_CDN = '//cdn.jsdelivr.net/npm/react@16/umd/react.production.min.js';

    const REACT_DOM_PATH_LOCAL = 'vendor/graphql-voyager/react-dom.js';
    const REACT_DOM_PATH_CDN = '//cdn.jsdelivr.net/npm/react@16/umd/react-dom.production.min.js';

    const JS_PATH_LOCAL = 'vendor/graphql-voyager/voyager.js';
    const JS_PATH_CDN = '//cdn.jsdelivr.net/npm/graphql-voyager/dist/voyager.min.js';

    const CSS_PATH_LOCAL = 'vendor/graphql-voyager/voyager.css';
    const CSS_PATH_CDN = '//cdn.jsdelivr.net/npm/graphql-voyager/dist/voyager.css';

    const FAVICON_PATH_LOCAL = 'vendor/graphql-voyager/favicon.png';
    const FAVICON_PATH_CDN = '//apis.guru/graphql-voyager/icons/favicon-32x32.png';

    protected $signature = 'graphql-voyager:download-assets';

    protected $description = 'Download the newest version of the GraphQL Voyager assets to serve them locally.';

    public function handle(): void
    {
        $this->fileForceContents(
            self::publicPath(self::REACT_DOM_PATH_LOCAL),
            file_get_contents('https:'.self::REACT_DOM_PATH_CDN)
        );
        $this->fileForceContents(
            self::publicPath(self::REACT_PATH_LOCAL),
            file_get_contents('https:'.self::REACT_PATH_CDN)
        );
        $this->fileForceContents(
            self::publicPath(self::JS_PATH_LOCAL),
            file_get_contents('https:'.self::JS_PATH_CDN)
        );
        $this->fileForceContents(
            self::publicPath(self::CSS_PATH_LOCAL),
            file_get_contents('https:'.self::CSS_PATH_CDN)
        );
        $this->fileForceContents(
            self::publicPath(self::FAVICON_PATH_LOCAL),
            file_get_contents('https:'.self::FAVICON_PATH_CDN)
        );
    }

    protected function fileForceContents(string $filePath, string $contents): void
    {
        // Ensure the directory exists
        $directory = dirname($filePath);
        if (! is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents(
            $filePath,
            $contents
        );
    }

    public static function reactPath(): string
    {
        return self::assetPath(self::REACT_PATH_LOCAL, self::REACT_PATH_CDN);
    }

    public static function reactDomPath(): string
    {
        return self::assetPath(self::REACT_DOM_PATH_LOCAL, self::REACT_DOM_PATH_CDN);
    }

    public static function jsPath(): string
    {
        return self::assetPath(self::JS_PATH_LOCAL, self::JS_PATH_CDN);
    }

    public static function cssPath(): string
    {
        return self::assetPath(self::CSS_PATH_LOCAL, self::CSS_PATH_CDN);
    }

    public static function faviconPath(): string
    {
        return self::assetPath(self::FAVICON_PATH_LOCAL, self::FAVICON_PATH_CDN);
    }

    protected static function assetPath(string $local, string $cdn): string
    {
        return file_exists(self::publicPath($local))
            ? self::asset($local)
            : $cdn;
    }

    protected static function asset(string $path): string
    {
        return app('url')->asset($path);
    }

    protected static function publicPath(string $path): string
    {
        return app()->basePath('public/'.$path);
    }
}
