<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.16
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Lara\Middlewares;

use Closure;
use Hedera\Models\SharedCustomers;
use Hedera\Services\ConnectorService;
use Illuminate\Support\Facades\Log;

abstract class CustomerAuth
{
    /**
     * @var \GraphAware\Neo4j\OGM\EntityManager $em
     * */
    protected $em;

    /**
     * @var string $customerClass
     * */
    protected static $customerClass = SharedCustomers::class;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!$this->load($request)) {
            return response(['status' => false, 'message' => 'Unauthorized.'], 401);
        }

        return $next($request);
    }

    /**
     * @param \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function load($request): bool
    {
        $token = $request->segment(3);

        if (empty($token)) {
            return false;
        }

        try {
            $service = new ConnectorService();
            $this->em = $service->getConnection();
            if (empty($this->em)) {
                throw new \Exception('Not init default EntityManager');
            }

            $repository = $this->em->getRepository(static::$customerClass);
            /**
             * @var SharedCustomers|null $model
             * */
            $model = $repository->findOneBy(['key' => $token]);
            if (empty($model)) {
                throw new \Exception('For token [' . $token . '] SharedCustomers not found');
            }

            return $this->isAuth($request, $model);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return false;
    }

    /**
     * @param \Illuminate\Http\Request  $request
     * @param SharedCustomers $sharedCustomers
     * @return bool
     */
    abstract protected function isAuth($request, $sharedCustomers): bool;
}
