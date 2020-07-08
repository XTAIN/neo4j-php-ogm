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

namespace Hedera\Lara\Guard;

use Hedera\Services\AnemoneOAuth2Service;
use Hedera\Services\GuardService;

class UserRepository
{
    private $configs;

    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * @param string $token
     * @return User|null
     */
    public function getUser(string $token): ?User
    {
        $guardService = new GuardService($token);
        if ($guardService->isReady()) {
            $user = new User($guardService);

            /**
             * @var AnemoneOAuth2Service $oauthService
             * */
            $oauthService = app(AnemoneOAuth2Service::class);
            $oauthService->add($user->getSharedAmocrm(), $user->getSharedOauth(), $user->getSharedIntegrations());

            return $user;
        }

        return null;
    }
}
