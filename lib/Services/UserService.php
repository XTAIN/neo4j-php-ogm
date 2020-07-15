<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.15
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

interface UserService
{
    /**
     * @return ConnectorService
     * */
    public function getConnectorService(): ConnectorService;

    /**
     * @return BeSmartService
     */
    public function getSmartService();

    /**
     * @return bool
     * */
    public function isReady(): bool;
}
