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

namespace Hedera\Lara\Guard;

use Illuminate\Contracts\Auth\Authenticatable;

interface URepository
{
    /**
     * @param string $token
     * @return Authenticatable|null
     */
    public function getUser(string $token): ?Authenticatable;
}
