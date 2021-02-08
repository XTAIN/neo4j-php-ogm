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

use Illuminate\Contracts\Auth\Authenticatable;
use Kreait\Firebase\Factory;
use Lcobucci\JWT\Token;

class SimpleUser implements Authenticatable
{
    /**
     * @var Token $decodedToken
     */
    protected $decodedToken = null;
    /**
     * @var Factory $factory
     */
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Token $tokenData
     */
    public function setTokenData(Token $tokenData)
    {
        $this->decodedToken = $tokenData;
    }

    /**
     * @return Token
     */
    public function getTokenData()
    {
        return $this->decodedToken;
    }

    /**
     * @return Factory
     */
    public function getFactory(): Factory
    {
        return $this->factory;
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
