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

---

### Using Auth Guarded user and GuardService

```php
// some controller

class TestController extends Controller
{
    public function index(Request $request)
    {
        /**
         * @var User $user
         * */
        $user = $request->user();

        /**
         * @var \Hedera\Models\SharedApikeys $sharedApiKey
         * */
        $sharedApiKey = $user->getSharedApiKey();

        /**
         * @var \Hedera\Models\SharedCustomersServices $sharedCustomersServices
         * */
        $sharedCustomersServices = $user->getSharedCustomersServices();

        /**
         * @var \Hedera\Models\SharedCustomers $sharedCustomers
         * */
        $sharedCustomers = $user->getSharedCustomers();

        /**
         * @var \Hedera\Models\SharedPeriods $sharedPeriods
         * */
        $sharedPeriods = $user->getSharedPeriods();

        /**
         * @var \Hedera\Models\SharedOauth $sharedOauth
         * */
        $sharedOauth = $user->getSharedOauth();

        /**
         * @var \Hedera\Models\SharedIntegrations $sharedIntegrations
         * */
        $sharedIntegrations = $user->getSharedIntegrations();

        /**
         * @var \Hedera\Models\SharedAmocrm $sharedAmocrm
         * */
        $sharedAmocrm = $user->getSharedAmocrm();

        /**
         * @var \Hedera\Services\GuardService $guardService
         * */
        $guardService = $user->getGuardService();

        // validating
        try {
            $guardService
                ->validateApiKey()
                ->validatePeriod()
                ->validateAmocrm();
        } catch (GuardingException $exception) {
            return response()->json(['status' => false]);
        }

        // get status guard service
        $guardService->isReady();

        $defaultEntityManager = $guardService->getConnectorService()->getConnection();
        $neo4jEntityManager = $guardService->getConnectorService()->getConnection('neo4j');

        $guardService->getConnectorService()->addConnection('new_neo4j', [/** config */]);
        $guardService->getConnectorService()->addConnection('new_neo4j_default', [/** config */], true);

        /**
         * @var \Hedera\Repositories\Tomato\TomatoTokensConfigsRepository $tomatoTokensConfigsRepository
         * */
        $tomatoTokensConfigsRepository = $defaultEntityManager->getRepository(TomatoTokensConfigs::class);

        $models = $tomatoTokensConfigsRepository->findAll();

        foreach ($models as $model) {
            /**
             * @var \Hedera\Models\Tomato\TomatoTokensConfigs $model
             * */
            $name = $model->getName();
            // ...

            $model->setName('new name');

            // relations
            /**
             * @var \Doctrine\Common\Collections\Collection $collection
             * */
            $collection = $model->getTomatoCustomersConfigs();

            /**
             * @var \Hedera\Models\Tomato\TomatoCustomersConfigs|null $one
             * */
            $one = $collection->first();
            $senderData = $one->getSender();

            // ...

            $one->setRecipient((object)['other' => 'data']);
        }

        // commit the change to neo4j server
        $defaultEntityManager->flush();

        // clear cached guard data
        $guardService->getSmartService()->clear();

        $bearerToken = 'new_token';
        // load new data from neo4j server for next $bearerToken user
        $guardService->getSmartService()->init($bearerToken);

        return response()->json(['status' => true]);
    }
}
```



