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

$OIDC_JSON = base_path(env('KEYCLOAK_OIDC_JSON', 'keycloak.json'));
$FIREBASE_JSON = base_path(env('FIREBASE_JSON', 'firebase_credentials.json'));

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
            'cache' => env('HEDERA_CACHE') ? storage_path(env('HEDERA_CACHE')) : null,
            'listeners' => env('HEDERA_LISTENERS', true),
        ],
    ],

    'keycloak' => [
        'oidc' => file_exists($OIDC_JSON) ? json_decode(file_get_contents($OIDC_JSON), true) : null,
        'public_key' => env('KEYCLOAK_PUBLIC_KEY', null),
    ],

    'firebase' => [
        'credentials' => file_exists($FIREBASE_JSON) ? json_decode(file_get_contents($FIREBASE_JSON), true) : null,
    ],
];
