<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.15
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

use Hedera\Exceptions\GuardingException;

class ModuleService implements UserService
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
        $this->smartService = new ModuleSmartService($this->connectorService->getConnection());
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
     * @return ModuleSmartService
     * */
    public function getSmartService(): ModuleSmartService
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

    /**
     * @return self
     * @throws GuardingException
     */
    public function validateModule()
    {
        $model = $this->smartService->getSharedModules();

        if (empty($model)) {
            throw new GuardingException('Model SharedModules not found');
        }

        return $this;
    }
}
