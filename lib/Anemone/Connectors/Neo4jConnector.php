<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.08
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Anemone\Connectors;

use Anemone\Contracts\BeAuthConnector;
use Hedera\Models\SharedOauth;
use Hedera\Services\AnemoneOAuth2Service;
use Hedera\Services\ConnectorService;

class Neo4jConnector implements BeAuthConnector
{
    /**
     * @var AnemoneOAuth2Service $oauthService
     * */
    protected $oauthService;

    public function __construct()
    {
        $this->oauthService = AnemoneOAuth2Service::context();
    }

    public function read(array $authData): array
    {
        $model = $this->oauthService->find($authData['domain'])->first();
        if (empty($model)) {
            return [];
        }

        /**
         * @var \Hedera\Models\SharedOauth|null $oauth
         * */
        $oauth = $model['oauth'];

        return isset($oauth)
            ? [
                'access_token' => $oauth->getAccessToken(),
                'refresh_token' => $oauth->getRefreshToken(),
                'token_type' => $oauth->getTokenType(),
            ]
            : [];
    }

    public function write(array $authData, array $refreshAuthData): bool
    {
        $model = $this->oauthService->find($authData['domain'])->first();
        if (isset($model['oauth']) && !empty($refreshAuthData)) {
            /**
             * @var \Hedera\Models\SharedOauth|null $oauth
             * */
            $oauth = $model['oauth'];
            if (empty($oauth)) {
                return false;
            }

            $emService = new ConnectorService();
            $em = $emService->getConnection();
            if (empty($em)) {
                return false;
            }

            $repository = $em->getRepository(SharedOauth::class);
            /**
             * @var \Hedera\Models\SharedOauth|null $next
             * */
            $next = $repository->find($oauth->getId());
            if (empty($next)) {
                return false;
            }

            if (empty($refreshAuthData['expires_in'])) {
                $next->setExpiresIn($refreshAuthData['expires_in']);
                $oauth->setExpiresIn($refreshAuthData['expires_in']);
            }

            if (empty($refreshAuthData['access_token'])) {
                $next->setAccessToken($refreshAuthData['access_token']);
                $oauth->setAccessToken($refreshAuthData['access_token']);
            }

            if (empty($refreshAuthData['refresh_token'])) {
                $next->setRefreshToken($refreshAuthData['refresh_token']);
                $oauth->setRefreshToken($refreshAuthData['refresh_token']);
            }

            $em->flush();

            return true;
        }

        return false;
    }
}
