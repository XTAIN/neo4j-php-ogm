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

use Hedera\Services\KeycloakService;
use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    /**
     * @var KeycloakService $moduleService
     */
    private $userService;

    /**
     * @var array $decodedToken
     */
    private $decodedToken = [];

    /**
     * @param KeycloakService $userService
     */
    public function __construct(KeycloakService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param array $tokenData
     */
    public function setTokenData(array $tokenData)
    {
        $this->decodedToken = $tokenData;
    }

    /**
     * @return array
     */
    public function getTokenData()
    {
        return $this->decodedToken;
    }

    /**
     * @return KeycloakService
     */
    public function getUserService(): KeycloakService
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
