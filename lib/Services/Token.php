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

namespace Hedera\Services;

use Firebase\JWT\JWT;

class Token
{
    /**
     * Decode a JWT token
     *
     * @param string $token
     * @param string $publicKey
     * @return mixed|null
     */
    public static function decode(string $token, string $publicKey)
    {
        $publicKey = self::buildPublicKey($publicKey);
        return $token ? json_decode(json_encode(JWT::decode($token, $publicKey, ['RS256'])), true) : null;
    }

    /**
     * Build a valid public key from a string
     *
     * @param string $key
     * @return mixed
     */
    private static function buildPublicKey(string $key)
    {
        return "-----BEGIN PUBLIC KEY-----\n" . wordwrap($key, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
    }
}
