<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;
use Hedera\Helpers\WithTimestamps;

/**
 * @OGM\Node(label="SharedAmocrm", repository="Hedera\Repositories\SharedAmocrmRepository")
 */
class SharedAmocrm implements \JsonSerializable
{
    use EntityFactory;
    use SerializationHelper;
    use WithTimestamps;

    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $domain;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $login;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $password;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int", key="account_id")
     */
    protected $accountId;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $confirmed;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="AMOCRM_IN", direction="INCOMING", collection=true, mappedBy="sharedAmocrm", targetEntity="SharedCustomersServices")
     */
    protected $sharedCustomersServices;

    /**
     * @var SharedCustomers|null
     *
     * @OGM\Relationship(type="AMOCRM_CU_IN", direction="OUTGOING", collection=false, mappedBy="sharedAmocrm", targetEntity="SharedCustomers")
     */
    protected $sharedCustomers;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="AMOCRM_CU_USER_IN", direction="INCOMING", collection=true, mappedBy="sharedAmocrm", targetEntity="SharedCustomersUsers")
     */
    protected $sharedCustomersUsers;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="AMOCRM_CU_WIDGET_IN", direction="INCOMING", collection=true, mappedBy="sharedAmocrm", targetEntity="SharedCustomersWidgets")
     */
    protected $sharedCustomersWidgets;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="AMOCRM_INTEGR_IN", direction="INCOMING", collection=true, mappedBy="sharedAmocrm", targetEntity="SharedIntegrations")
     */
    protected $sharedIntegrations;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="AMOCRM_OAUTH_IN", direction="INCOMING", collection=true, mappedBy="sharedAmocrm", targetEntity="SharedOauth")
     */
    protected $sharedOauth;

    /**
     * @var SharedAmocrmLicenses|null
     *
     * @OGM\Relationship(type="AMOCRM_LICENSE_IN", direction="OUTGOING", collection=false, mappedBy="sharedAmocrm", targetEntity="SharedAmocrmLicenses")
     */
    protected $sharedAmocrmLicenses;

    /**
     * @var SharedModules|null
     *
     * @OGM\Relationship(type="AMOCRM_MODULE_IN", direction="OUTGOING", collection=false, mappedBy="sharedAmocrm", targetEntity="SharedModules")
     */
    protected $sharedModules;

    public function __construct()
    {
        $this->sharedCustomersServices = new HederaCollection();
        $this->sharedCustomersUsers = new HederaCollection();
        $this->sharedCustomersWidgets = new HederaCollection();
        $this->sharedIntegrations = new HederaCollection();
        $this->sharedOauth = new HederaCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int|null
     */
    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    /**
     * @param int|null $accountId
     */
    public function setAccountId(?int $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    /**
     * @param bool $confirmed
     */
    public function setConfirmed(bool $confirmed): void
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return Collection
     */
    public function getSharedCustomersServices(): Collection
    {
        return $this->sharedCustomersServices;
    }

    /**
     * @param Collection $sharedCustomersServices
     */
    public function setSharedCustomersServices(Collection $sharedCustomersServices): void
    {
        $this->sharedCustomersServices = $sharedCustomersServices;
    }

    /**
     * @return SharedCustomers|null
     */
    public function getSharedCustomers(): ?SharedCustomers
    {
        return $this->sharedCustomers;
    }

    /**
     * @param SharedCustomers|null $sharedCustomers
     */
    public function setSharedCustomers(?SharedCustomers $sharedCustomers): void
    {
        $this->sharedCustomers = $sharedCustomers;
    }

    /**
     * @return Collection
     */
    public function getSharedCustomersUsers(): Collection
    {
        return $this->sharedCustomersUsers;
    }

    /**
     * @param Collection $sharedCustomersUsers
     */
    public function setSharedCustomersUsers(Collection $sharedCustomersUsers): void
    {
        $this->sharedCustomersUsers = $sharedCustomersUsers;
    }

    /**
     * @return Collection
     */
    public function getSharedCustomersWidgets(): Collection
    {
        return $this->sharedCustomersWidgets;
    }

    /**
     * @param Collection $sharedCustomersWidgets
     */
    public function setSharedCustomersWidgets(Collection $sharedCustomersWidgets): void
    {
        $this->sharedCustomersWidgets = $sharedCustomersWidgets;
    }

    /**
     * @return Collection
     */
    public function getSharedIntegrations(): Collection
    {
        return $this->sharedIntegrations;
    }

    /**
     * @param Collection $sharedIntegrations
     */
    public function setSharedIntegrations(Collection $sharedIntegrations): void
    {
        $this->sharedIntegrations = $sharedIntegrations;
    }

    /**
     * @return Collection
     */
    public function getSharedOauth(): Collection
    {
        return $this->sharedOauth;
    }

    /**
     * @param Collection $sharedOauth
     */
    public function setSharedOauth(Collection $sharedOauth): void
    {
        $this->sharedOauth = $sharedOauth;
    }

    /**
     * @return SharedAmocrmLicenses|null
     */
    public function getSharedAmocrmLicenses(): ?SharedAmocrmLicenses
    {
        return $this->sharedAmocrmLicenses;
    }

    /**
     * @param SharedAmocrmLicenses|null $sharedAmocrmLicenses
     */
    public function setSharedAmocrmLicenses(?SharedAmocrmLicenses $sharedAmocrmLicenses): void
    {
        $this->sharedAmocrmLicenses = $sharedAmocrmLicenses;
    }

    /**
     * @return SharedModules|null
     */
    public function getSharedModules(): ?SharedModules
    {
        return $this->sharedModules;
    }

    /**
     * @param SharedModules|null $sharedModules
     */
    public function setSharedModules(?SharedModules $sharedModules): void
    {
        $this->sharedModules = $sharedModules;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
