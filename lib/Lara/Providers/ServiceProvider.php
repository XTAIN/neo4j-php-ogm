<?php
/**
 *
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.08
 * @link      https://fabrika-klientov.ua
 */

namespace Hedera\Lara\Providers;

use Hedera\Services\AnemoneOAuth2Service;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    protected static $prefix = 'api/v0';
    protected static $namespace = 'Hedera\Lara\Controllers';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRoutes();

        $this->app->singleton(
            AnemoneOAuth2Service::class,
            function ($app) {
                return new AnemoneOAuth2Service();
            }
        );
    }

    /**
     * Register the Horizon routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group(
            [
                'prefix' => static::$prefix,
                'namespace' => static::$namespace,
            ],
            function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            }
        );
    }
}
