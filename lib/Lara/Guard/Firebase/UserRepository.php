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

use Hedera\Lara\Guard\URepository;
use Hedera\Services\FirestoreService;
use Illuminate\Contracts\Auth\Authenticatable;
use Kreait\Firebase\Factory;

class UserRepository implements URepository
{
    private $configs;
    private $factory;

    public function __construct(array $configs, Factory $factory)
    {
        $this->configs = $configs;
        $this->factory = $factory;
    }

    /**
     * @param string $identifier
     * @return Authenticatable|null
     */
    public function getUser(string $identifier): ?Authenticatable
    {
        $userService = new FirestoreService($identifier);
        if ($userService->isReady()) {
            return new User($userService, $this->factory);
        }

        return null;
    }
}
