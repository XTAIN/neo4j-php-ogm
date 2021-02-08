<?php
/**
 * Created by IntelliJ IDEA.
 * User: jarvis
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2021 Fabrika-Klientov
 * @version   GIT: 21.02.08
 * @link      https://fabrika-klientov.ua
 */

namespace Hedera\Lara\Guard\Firebase;

use Firebase\Auth\Token\Exception\InvalidToken;
use Hedera\Exceptions\GuardingException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Kreait\Firebase\Factory;

class FirebaseGuardSimple implements Guard
{
    protected $provider;
    protected $request;
    protected $config;
    /**
     * @var Factory $factory
     * */
    protected $factory;
    /**
     * @var Authenticatable $user
     * */
    protected $user;
    /**
     * @var \Lcobucci\JWT\Token\Plain $decodedToken
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
            $this->factory = (new Factory())
                ->withServiceAccount($this->config['keycloak']['firebase']['credentials'] ?? []);
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

        $user = new SimpleUser($this->factory);
        $user->setTokenData($this->decodedToken);
        $this->setUser($user);

        return true;
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
            $auth = $this->factory->createAuth();
            $this->decodedToken = $auth->verifyIdToken($this->request->bearerToken(), true);
        } catch (InvalidToken $e) {
            throw new GuardingException('The token is invalid: ' . $e->getMessage());
        } catch (\InvalidArgumentException $e) {
            throw new GuardingException('The token could not be parsed: ' . $e->getMessage());
        } catch (\Exception $e) {
            throw new GuardingException($e->getMessage());
        }

        if ($this->decodedToken) {
            $this->validate();
        }
    }
}
