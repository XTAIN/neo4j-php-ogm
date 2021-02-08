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

use Hedera\Services\FirebaseService;
use Kreait\Firebase\Factory;

class User extends SimpleUser
{
    /**
     * @var FirebaseService $moduleService
     */
    private $userService;

    /**
     * @param FirebaseService $userService
     * @param Factory $factory
     */
    public function __construct(FirebaseService $userService, Factory $factory)
    {
        parent::__construct($factory);
        $this->userService = $userService;
    }

    /**
     * @return FirebaseService
     */
    public function getUserService(): FirebaseService
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
     * @return \Hedera\Models\SharedUsers
     * */
    public function getSharedUsers()
    {
        return $this->userService->getSmartService()->getSharedUsers();
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getSharedUsers()->getId();
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
