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

namespace Hedera\Lara\Guard\Keycloak;

use Hedera\Exceptions\GuardingException;
use Hedera\Lara\Guard\URepository;
use Hedera\Services\Token;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

class KeycloakGuard implements Guard
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
     * @var array $decodedToken
     * */
    protected $decodedToken;

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

        if (empty($this->config)) {
            \Log::error('Before using hedera guard - you should setting hedera config in config');
        } else {
            $this->repository = new UserRepository($this->config);
            $this->initUser();
        }
    }

    public function check()
    {
        return isset($this->user);
    }

    public function guest()
    {
        return !self::check();
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
        if (!$this->decodedToken) {
            return false;
        }

        $exp = $this->decodedToken['exp'] ?? 0;
        if (time() > $exp) {
            return false;
        }

        /**
         * @var User|null $user
         * */
        $user = $this->repository->getUser($this->decodedToken['sub']);
        if (isset($user)) {
            $user->setTokenData($this->decodedToken);
            $this->setUser($user);

            return true;
        }

        return false;
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }

    /**
     * @return void
     * @throws GuardingException
     */
    protected function initUser()
    {
        try {
            $this->decodedToken = Token::decode(
                $this->request->bearerToken(),
                $this->config['keycloak']['public_key'] ?? null
            );
        } catch (\Exception $e) {
            throw new GuardingException($e->getMessage());
        }

        if ($this->decodedToken) {
            $this->validate();
        }
    }
}
