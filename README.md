# Laravel GraphQL Voyager

Easily integrate [GraphQL Voyager](https://github.com/APIs-guru/graphql-voyager) into your Laravel projects.

[![GitHub license](https://img.shields.io/github/license/mll-lab/laravel-graphql-voyager.svg)](https://github.com/mll-lab/laravel-graphql-voyager/blob/master/LICENSE)
[![Packagist](https://img.shields.io/packagist/v/mll-lab/laravel-graphql-voyager.svg)](https://packagist.org/packages/mll-lab/laravel-graphql-voyager)
[![Packagist](https://img.shields.io/packagist/dt/mll-lab/laravel-graphql-voyager.svg)](https://packagist.org/packages/mll-lab/laravel-graphql-voyager)

# TODO FIX
[![StyleCI](https://github.styleci.io/repos/137498251/shield?branch=master)](https://github.styleci.io/repos/137498251)

[![voyager demo](https://github.com/APIs-guru/graphql-voyager/raw/master/docs/demo-gif.gif)](https://apis.guru/graphql-voyager/)

> **Please note**: This is not a GraphQL Server implementation, only a UI for exploring your schema.
> For the server component we recommend [nuwave/lighthouse](https://github.com/nuwave/lighthouse).

## Installation

    composer require mll-lab/laravel-graphql-voyager

If you are using Lumen, register the service provider in `bootstrap/app.php`

```php
$app->register(MLL\GraphQLVoyager\GraphQLVoyagerServiceProvider::class);
```

## Configuration

By default, GraphQL Voyager is reachable at `/graphql-voyager`
and assumes a running GraphQL endpoint at `/graphql`.

To change the defaults, publish the configuration with the following command:

    php artisan vendor:publish --tag=graphql-voyager-config

You will find the configuration file at `config/graphql-voyager.php`.

If you are using Lumen, copy it into that location manually and load the configuration
in your `boostrap/app.php`:

```php
$app->configure('graphql-voyager');
```

## Customization

To customize GraphQL Voyager even further, publish the view:

    php artisan vendor:publish --tag=graphql-voyager-view

You can use that for all kinds of customization.

### Change settings of the GraphQL Voyager instance

Check https://github.com/APIs-guru/graphql-voyager#properties for the allowed config options, for example:

```html
<div id="voyager">Loading...</div>
<script>
  function introspectionProvider(introspectionQuery) {
    // ... do a call to server using introspectionQuery provided
    // or just return pre-fetched introspection
  }

  // Render <Voyager />
  GraphQLVoyager.init(document.getElementById('voyager'), {
    introspection: introspectionProvider,
  });
</script>
```

## Local assets

If you want to serve the assets from your own server, you can download them with the command:

    php artisan graphql-voyager:download-assets

This puts the necessary CSS, JS and Favicon into your `public` directory. If you have
the assets downloaded, they will be used instead of the online version from the CDN.

## Security

If you do not want to enable GraphQL Voyager in production, you can disable it in the config file.
The easiest way is to set the environment variable `GRAPHQL_VOYAGER_ENABLED=false`.

To protect the route to GraphQL Voyager, add custom middleware in the config file.
