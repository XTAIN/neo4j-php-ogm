<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.15
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

interface BeSmartService
{
    public const DIRECTORY = __DIR__ . '/../../storage/hedera';
    public const EXPIRES = 3600;

    /**
     * @param string $identifier
     * @param bool $force
     * @return void
     */
    public function init(string $identifier, bool $force = false): void;

    /**
     * @return void
     */
    public function clear(): void;

    /**
     * @return bool
     * */
    public function isReady(): bool;
}
