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

use Hedera\Services\GuardService;
use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    /**
     * @var  GuardService $guardService
     */
    private $guardService;

    /**
     * @param GuardService $guardService
     */
    public function __construct(GuardService $guardService)
    {
        $this->guardService = $guardService;
    }

    /**
     * @return GuardService
     */
    public function getGuardService(): GuardService
    {
        return $this->guardService;
    }

    /**
     * @return \GraphAware\Neo4j\OGM\EntityManager|null
     */
    public function getEntityManager()
    {
        return $this->guardService->getConnectorService()->getConnection();
    }

    /**
     * @return \Hedera\Models\SharedCustomers
     * */
    public function getSharedCustomers()
    {
        return $this->guardService->getSmartService()->getSharedCustomers();
    }

    /**
     * @return \Hedera\Models\SharedCustomersServices
     * */
    public function getSharedCustomersServices()
    {
        return $this->guardService->getSmartService()->getSharedCustomersServices();
    }

    /**
     * @return \Hedera\Models\SharedApikeys
     * */
    public function getSharedApiKey()
    {
        return $this->guardService->getSmartService()->getSharedApiKey();
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     * */
    public function getSharedPeriods()
    {
        return $this->guardService->getSmartService()->getSharedPeriods();
    }

    /**
     * @return \Hedera\Models\SharedAmocrm
     * */
    public function getSharedAmocrm()
    {
        return $this->guardService->getSmartService()->getSharedAmocrm();
    }

    /**
     * @return \Hedera\Models\SharedOauth
     * */
    public function getSharedOauth()
    {
        return $this->guardService->getSmartService()->getSharedOauth();
    }

    /**
     * @return \Hedera\Models\SharedIntegrations
     * */
    public function getSharedIntegrations()
    {
        return $this->guardService->getSmartService()->getSharedIntegrations();
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getSharedCustomers()->getId();
    }

    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}
