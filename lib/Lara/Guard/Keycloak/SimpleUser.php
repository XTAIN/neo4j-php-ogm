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

use Illuminate\Contracts\Auth\Authenticatable;

class SimpleUser implements Authenticatable
{
    /**
     * @var array $decodedToken
     */
    protected $decodedToken = [];

    /**
     * @return void
     */
    public function __construct()
    {
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

    public function getAuthIdentifierName()
    {
        return 'sub';
    }

    public function getAuthIdentifier()
    {
        return $this->decodedToken['sub'] ?? null;
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
