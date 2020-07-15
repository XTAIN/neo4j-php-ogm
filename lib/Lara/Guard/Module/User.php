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

use Hedera\Services\ModuleService;
use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    /**
     * @var ModuleService $moduleService
     */
    private $userService;

    /**
     * @param ModuleService $userService
     */
    public function __construct(ModuleService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return ModuleService
     */
    public function getUserService(): ModuleService
    {
        return $this->userService;
    }

    /**
     * @param string|null $name
     * @return \GraphAware\Neo4j\OGM\EntityManager|null
     */
    public function getEntityManager(string $name = null)
    {
        return $this->userService->getConnectorService()->getConnection($name);
    }

    /**
     * @return \Hedera\Models\SharedCustomers
     * */
    public function getSharedCustomers()
    {
        return $this->userService->getSmartService()->getSharedCustomers();
    }

    /**
     * @return \Hedera\Models\SharedModules
     * */
    public function getSharedCustomersServices()
    {
        return $this->userService->getSmartService()->getSharedModules();
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getSharedCustomers()->getId();
    }

    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}
