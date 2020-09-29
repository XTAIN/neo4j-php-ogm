<?php
/**
 * Created by IntelliJ IDEA.
 * User: jarvis
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.09.29
 * @link      https://fabrika-klientov.ua
 */

namespace Hedera\Lara\Providers;

use Hedera\Lara\Guard\AccessTokenGuard;
use Hedera\Lara\Guard\Keycloak\KeycloakGuard;
use Hedera\Lara\Guard\Keycloak\KeycloakGuardSimple;
use Hedera\Lara\Guard\Keycloak\KeycloakProvider;
use Hedera\Lara\Guard\TokenToUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/../../../config/hedera.php' => config_path('hedera.php'),
            ],
            'config'
        );
    }

    public function register()
    {
        Auth::extend(
            'hedera',
            function ($app, $name, array $config) {
                // automatically build the DI, put it as reference
                $userProvider = app(TokenToUserProvider::class);
                $request = app('request');
                $config['hedera'] = config('hedera', null);

                return new AccessTokenGuard($userProvider, $request, $config);
            }
        );

        Auth::extend(
            'hedera_module',
            function ($app, $name, array $config) {
                // automatically build the DI, put it as reference
                $userProvider = app(TokenToUserProvider::class);
                $request = app('request');
                $config['hedera'] = config('hedera', null);
                $config['hedera_module'] = true;

                return new AccessTokenGuard($userProvider, $request, $config);
            }
        );

        Auth::extend(
            'hedera_keycloak',
            function ($app, $name, array $config) {
                // automatically build the DI, put it as reference
                $userProvider = app(KeycloakProvider::class);
                $request = app('request');
                $config['hedera'] = config('hedera', null);

                return new KeycloakGuard($userProvider, $request, $config);
            }
        );

        Auth::extend(
            'hedera_keycloak_simple',
            function ($app, $name, array $config) {
                // automatically build the DI, put it as reference
                $userProvider = app(KeycloakProvider::class);
                $request = app('request');
                $config['hedera'] = config('hedera', null);

                return new KeycloakGuardSimple($userProvider, $request, $config);
            }
        );
    }
}
