<?php
/**
 * Created by IntelliJ IDEA.
 * User: jarvis
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.15
 * @link      https://fabrika-klientov.ua
 */

namespace Hedera\Lara\Guard;

use Hedera\Lara\Guard\Module\UserRepository as ModuleUserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

class AccessTokenGuard implements Guard
{
    private $provider;
    private $request;
    private $config;
    /**
     * @var Authenticatable $user
     * */
    private $user;
    /**
     * @var URepository $repository
     * */
    protected $repository;

    /**
     * @param UserProvider $provider
     * @param $request
     * @param array $config
     */
    public function __construct(UserProvider $provider, $request, array $config)
    {
        $this->provider = $provider;
        $this->request = $request;
        $this->config = $config['hedera'] ?? null;

        $isModule = $config['hedera_module'] ?? false;

        if (empty($this->config)) {
            \Log::error('Before using hedera guard - you should setting hedera config in config');
        } else {
            $this->repository = $isModule ? new ModuleUserRepository($this->config) : new UserRepository($this->config);
            $this->initUser();
        }
    }

    public function check()
    {
        return isset($this->user);
    }

    public function guest()
    {
        // TODO: Implement guest() method.
    }

    public function user()
    {
        return $this->user;
    }

    public function id()
    {
        // TODO: Implement id() method.
    }

    public function validate(array $credentials = [])
    {
        // TODO: Implement validate() method.
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }

    /**
     * @return void
     */
    protected function initUser()
    {
        $token = last(explode(' ', $this->request->header('Authorization') ?? ''));

        $user = $this->repository->getUser($token);
        if (isset($user)) {
            $this->setUser($user);
        }
    }

}
