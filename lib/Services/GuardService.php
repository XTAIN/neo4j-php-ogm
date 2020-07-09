<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

use Hedera\Exceptions\GuardingException;

class GuardService
{
    /**
     * @var  ConnectorService $connectorService
     */
    private $connectorService;

    /**
     * @var  SmartService $smartService
     */
    private $smartService;

    /**
     * @param string $identifier
     * @param ConnectorService|null $connector
     */
    public function __construct(string $identifier, ConnectorService $connector = null)
    {
        $this->connectorService = $connector ?? new ConnectorService();
        $this->smartService = new SmartService($this->connectorService->getConnection());
        $this->smartService->init($identifier);
    }

    /**
     * @return ConnectorService
     * */
    public function getConnectorService(): ConnectorService
    {
        return $this->connectorService;
    }

    /**
     * @return SmartService
     */
    public function getSmartService(): SmartService
    {
        return $this->smartService;
    }

    /**
     * @return bool
     * */
    public function isReady(): bool
    {
        return $this->smartService->isReady();
    }
    /**
     * @throws GuardingException
     * @return self
     */
    public function validateApiKey()
    {
        $model = $this->smartService->getSharedApiKey();

        if (empty($model)) {
            throw new GuardingException('Model SharedApiKey not found');
        }

        if (!$model->isActive()) {
            throw new GuardingException('Model SharedApiKey is inactive');
        }

        return $this;
    }

    /**
     * @throws GuardingException
     * @return self
     */
    public function validatePeriod()
    {
        $collect = $this->smartService->getSharedPeriods();

        if (empty($collect) || $collect->isEmpty()) {
            throw new GuardingException('Model SharedPeriods not found');
        }

        $currentTime = time();

        foreach ($collect as $model) {
            if ($currentTime < strtotime($model->getDateEnd())) {
                return $this;
            }
        }

        throw new GuardingException('All periods is refused');
    }

    /**
     * @throws GuardingException
     * @return self
     */
    public function validateAmocrm()
    {
        $model = $this->smartService->getSharedAmocrm();
        $oauth = $this->smartService->getSharedOauth();

        if (empty($model)) {
            throw new GuardingException('Model SharedAmocrm not found');
        }

        if (empty($oauth)) {
            throw new GuardingException('Model SharedOauth not found');
        }

        return $this;
    }

}
