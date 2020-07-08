<?php
/**
 * Created by IntelliJ IDEA.
 * User: jarvis
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 */

return [
    'default' => env('HEDERA_CONNECTION', 'neo4j'),

    'connections' => [
        'neo4j' => [
            'url' => env('HEDERA_URL'),
            'host' => env('HEDERA_HOST', '127.0.0.1'),
            'port' => env('HEDERA_PORT', 7474),
            'username' => env('HEDERA_USERNAME'),
            'password' => env('HEDERA_PASSWORD'),
            'protocol' => env('HEDERA_PROTOCOL', 'http'),
            'cache' => env('HEDERA_CACHE'),
        ],
    ],
];
