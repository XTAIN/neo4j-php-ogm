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

namespace Hedera\Lara\Guard\Module;

use Hedera\Lara\Guard\URepository;
use Hedera\Services\ModuleService;
use Illuminate\Contracts\Auth\Authenticatable;

class UserRepository implements URepository
{
    private $configs;

    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * @param string $token
     * @return Authenticatable|null
     */
    public function getUser(string $token): ?Authenticatable
    {
        $userService = new ModuleService($token);
        if ($userService->isReady()) {
            return new User($userService);
        }

        return null;
    }
}
