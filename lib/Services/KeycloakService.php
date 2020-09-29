<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.09.29
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

/**
 * Service for guarding oauth2 apps from keycloak server.
 * Use Keycloak server as identifier oauth2 token and load other entities as SharedUsers, SharedRoles, SharedScopes
 * */
class KeycloakService implements UserService
{
    /**
     * @var ConnectorService $connectorService
     */
    private $connectorService;

    /**
     * @var ModuleSmartService smartService
     */
    private $smartService;

    /**
     * @param string $identifier
     * @param ConnectorService|null $connector
     */
    public function __construct(string $identifier, ConnectorService $connector = null)
    {
        $this->connectorService = $connector ?? new ConnectorService();
        $this->smartService = new KeycloakSmartService($this->connectorService->getConnection());
        $this->smartService->init($identifier);
    }

    /**
     * @inheritDoc
     * */
    public function getConnectorService(): ConnectorService
    {
        return $this->connectorService;
    }

    /**
     * @return KeycloakSmartService
     */
    public function getSmartService(): KeycloakSmartService
    {
        return $this->smartService;
    }

    /**
     * @inheritDoc
     * */
    public function isReady(): bool
    {
        return $this->smartService->isReady();
    }
}
