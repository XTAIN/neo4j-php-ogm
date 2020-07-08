## SETUP

1. For `config/app.php` in section providers add **Hedera Providers**

```php
    'providers' => [
        // ...

        Hedera\Lara\Providers\ServiceProvider::class,
        Hedera\Lara\Providers\AuthServiceProvider::class,

```

2. Publish the providers data:

`php artisan vendor:publish  --provider="Hedera\Lara\Providers\AuthServiceProvider"`

and setting the `config/hedera.php` config file.

3. In `config/auth.php` add guard as:

```php

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],

        'hedera' => [ // <- add
            'driver' => 'hedera',
            'provider' => 'users',
            'hash' => false,
        ],
    ],
```

4. Guard your routes (as ex.:)

```php
// Ex.:
// file RouteServiceProvider.php

class RouteServiceProvider extends ServiceProvider
{
    // ...

    protected function mapApiRoutes()
    {
        Route::prefix('api/v1')
            ->middleware('auth:hedera') // <- add guard middleware
            ->namespace($this->namespace . '\Api\V1')
            ->group(base_path('routes/api.v1.php'));
    }
}

```
