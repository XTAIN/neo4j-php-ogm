<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

use Anemone\Client as AnemoneClient;
use Hedera\Exceptions\GuardingException;
use Hedera\Models\SharedOauth;

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
     * @param string|null $domain
     * @return AnemoneClient|null
     * @throws \Anemone\Exceptions\InvalidDataException
     */
    public function getAnemoneClient(string $domain = null): ?AnemoneClient
    {
        $service = AnemoneOAuth2Service::context();
        $authData = $service->find($domain ?? $this->smartService->getSharedAmocrm()->getDomain())->first();

        if (empty($authData)) {
            return null;
        }

        /**
         * @var \Hedera\Models\SharedAmocrm $amocrm
         * */
        $amocrm = $authData['amocrm'];
        /**
         * @var \Hedera\Models\SharedOauth $oauth
         * */
        $oauth = $authData['oauth'];
        /**
         * @var \Hedera\Models\SharedIntegrations $integration
         * */
        $integration = $authData['integration'];

        $token_type = $oauth->getTokenType();
        $links = $integration->getLinks();

        // add listener for refresh token event
        $service->addListener(function (SharedOauth $oauth) {
            $this->smartService->clear();
        });

        return new AnemoneClient(
            [
                "domain" => $amocrm->getDomain(),
                "token_type" => $token_type ?? 'Bearer',
                "access_token" => $oauth->getAccessToken(),
                "refresh_token" => $oauth->getRefreshToken(),
                "client_secret" => $integration->getSecret(),
                "client_id" => $integration->getIntegrationUuid(),
                'redirect_uri' => $links->redirect_uri->href ?? '',
            ]
        );
    }

    /**
     * @return bool
     * */
    public function isReady(): bool
    {
        return $this->smartService->isReady();
    }

    /**
     * @return self
     * @throws GuardingException
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
     * @return self
     * @throws GuardingException
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
     * @return self
     * @throws GuardingException
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
