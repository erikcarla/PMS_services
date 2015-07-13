# oauth2-server-lumen
A Lumen bridge for lucadegasperi/oauth2-server-laravel.

## Installation

### Register package

In your ```bootstrap/app.php``` register service providers

```
$app->register('LucaDegasperi\OAuth2Server\Storage\FluentStorageServiceProvider');
$app->register('Optimus\OAuth2Server\OAuth2ServerServiceProvider');
```

... and middleware

```
$app->middleware([
    'LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware'
]);
```

... and route middleware

```
$app->routeMiddleware([
    'check-authorization-params' => 'Optimus\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware',
    'csrf' => 'Laravel\Lumen\Http\Middleware\VerifyCsrfToken',
    'oauth' => 'Optimus\OAuth2Server\Middleware\OauthMiddleware',
    'oauth-owner' => 'Optimus\OAuth2Server\Middleware\OAuthOwnerMiddleware'
]);
```

### Copy config

Copy ```vendor/lucadegasperi/oauth2-server-laravel/config/oauth2.php``` to your own config folder. It has to be 
the correct config folder as it is registered using ```$app->configure()```.

### Migrate

Run ```php artisan migrate --path=vendor/lucadegasperi/oauth2-server-laravel/migrations```

## Usage

The package is now installed for Lumen. Usage is the same as with lucadegasperi/oauth2-server-laravel, so I suggest you read 
the [wiki](https://github.com/lucadegasperi/oauth2-server-laravel/wiki) for usage.