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

use Hedera\Exceptions\GuardingException;
use Hedera\Lara\Guard\URepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

class FirebaseGuard extends FirebaseGuardSimple implements Guard
{
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
        parent::__construct($provider, $request, $config);

        if (empty($this->config)) {
            return;
        }

        $this->repository = new UserRepository($this->config, $this->factory);
        try {
            parent::initUser();
        } catch (GuardingException $exception) {
            \Log::error($exception->getMessage());
        }
    }

    public function validate(array $credentials = [])
    {
        if (!$this->decodedToken) {
            return false;
        }

        $sub = $this->decodedToken->claims()->get('sub');
        if (empty($sub)) {
            return false;
        }

        /**
         * @var User|null $user
         * */
        $user = $this->repository->getUser($sub);
        if (isset($user)) {
            $user->setTokenData($this->decodedToken);
            $this->setUser($user);

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function initUser()
    {
    }
}
