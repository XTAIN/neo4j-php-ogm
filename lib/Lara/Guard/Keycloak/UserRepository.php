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

use Hedera\Lara\Guard\URepository;
use Hedera\Services\KeycloakService;
use Illuminate\Contracts\Auth\Authenticatable;

class UserRepository implements URepository
{
    private $configs;

    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * @param string $identifier
     * @return Authenticatable|null
     */
    public function getUser(string $identifier): ?Authenticatable
    {
        $userService = new KeycloakService($identifier);
        if ($userService->isReady()) {
            return new User($userService);
        }

        return null;
    }
}
