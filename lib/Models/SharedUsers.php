<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.09.28
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;
use Hedera\Helpers\WithTimestamps;
use Hedera\Relations\SharedUsersSharedCustomersPartnerRoles;
use Hedera\Relations\SharedUsersSharedCustomersRoles;

/**
 * @OGM\Node(label="SharedUsers", repository="Hedera\Repositories\SharedUsersRepository")
 */
class SharedUsers implements \JsonSerializable
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
    protected $name;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $username;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $email;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", key="keycloak_id")
     */
    protected $keycloakId;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="string", key="is_partner")
     */
    protected $partner;

    /**
     * @var mixed|null
     *
     * @OGM\Property(type="array", key="additional_info")
     * @OGM\Convert(type="nested")
     */
    protected $additionalInfo;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $lang;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SHARED_CONTACTS_TO_SHARED_USERS", direction="INCOMING", collection=true, mappedBy="sharedUsers", targetEntity="Hedera\Models\SharedContacts")
     */
    protected $sharedContacts;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SHARED_USERS_CONFIGS_TO_SHARED_USERS", direction="INCOMING", collection=true, mappedBy="sharedUsers", targetEntity="SharedUsersConfigs")
     */
    protected $sharedUsersConfigs;

    /**
     * @var Collection<\Hedera\Relations\SharedUsersSharedCustomersRoles>
     *
     * @OGM\Relationship(relationshipEntity="Hedera\Relations\SharedUsersSharedCustomersRoles", type="SHARED_USERS_TO_SHARED_CUSTOMERS_ROLES", direction="OUTGOING", collection=true, mappedBy="sharedUsers")
     */
    protected $sharedCustomersRoles;

    /**
     * @var Collection<\Hedera\Relations\SharedUsersSharedCustomersPartnerRoles>
     *
     * @OGM\Relationship(relationshipEntity="Hedera\Relations\SharedUsersSharedCustomersPartnerRoles", type="SHARED_USERS_TO_SHARED_CUSTOMERS_PARTNER_ROLES", direction="OUTGOING", collection=true, mappedBy="sharedUsers")
     */
    protected $sharedCustomersPartnerRoles;

    /**
     * @var SharedRoles|null
     *
     * @OGM\Relationship(type="SHARED_USERS_TO_SHARED_ROLES", direction="OUTGOING", collection=false, mappedBy="sharedUsers", targetEntity="SharedRoles")
     */
    protected $sharedRoles;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SHARED_USERS_TO_SHARED_SCOPES", direction="OUTGOING", collection=true, mappedBy="sharedUsers", targetEntity="SharedScopes")
     */
    protected $sharedScopes;

    public function __construct()
    {
        $this->sharedContacts = new HederaCollection();
        $this->sharedUsersConfigs = new HederaCollection();
        $this->sharedCustomersRoles = new HederaCollection();
        $this->sharedCustomersPartnerRoles = new HederaCollection();
        $this->sharedRoles = new HederaCollection();
        $this->sharedScopes = new HederaCollection();
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getKeycloakId(): ?string
    {
        return $this->keycloakId;
    }

    /**
     * @param string|null $keycloakId
     */
    public function setKeycloakId(?string $keycloakId): void
    {
        $this->keycloakId = $keycloakId;
    }

    /**
     * @return bool|null
     */
    public function isPartner(): ?bool
    {
        return $this->partner;
    }

    /**
     * @param bool|null $partner
     */
    public function setPartner(?bool $partner): void
    {
        $this->partner = $partner;
    }

    /**
     * @return mixed|null
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    /**
     * @param mixed|null $additionalInfo
     */
    public function setAdditionalInfo($additionalInfo): void
    {
        $this->additionalInfo = $additionalInfo;
    }

    /**
     * @return string|null
     */
    public function getLang(): ?string
    {
        return $this->lang;
    }

    /**
     * @param string|null $lang
     */
    public function setLang(?string $lang): void
    {
        $this->lang = $lang;
    }

    /**
     * @return Collection
     */
    public function getSharedContacts(): Collection
    {
        return $this->sharedContacts;
    }

    /**
     * @param Collection $sharedContacts
     */
    public function setSharedContacts(Collection $sharedContacts): void
    {
        $this->sharedContacts = $sharedContacts;
    }

    /**
     * @return Collection
     */
    public function getSharedUsersConfigs(): Collection
    {
        return $this->sharedUsersConfigs;
    }

    /**
     * @param Collection $sharedUsersConfigs
     */
    public function setSharedUsersConfigs(Collection $sharedUsersConfigs): void
    {
        $this->sharedUsersConfigs = $sharedUsersConfigs;
    }

    /**
     * @return Collection
     */
    public function getSharedCustomersRoles(): Collection
    {
        return $this->sharedCustomersRoles;
    }

    /**
     * @param Collection $sharedCustomersRoles
     */
    public function setSharedCustomersRoles(Collection $sharedCustomersRoles): void
    {
        $this->sharedCustomersRoles = $sharedCustomersRoles;
    }

    /**
     * @return Collection
     */
    public function getSharedCustomersPartnerRoles(): Collection
    {
        return $this->sharedCustomersPartnerRoles;
    }

    /**
     * @param Collection $sharedCustomersPartnerRoles
     */
    public function setSharedCustomersPartnerRoles(Collection $sharedCustomersPartnerRoles): void
    {
        $this->sharedCustomersPartnerRoles = $sharedCustomersPartnerRoles;
    }

    /**
     * @return SharedRoles|null
     */
    public function getSharedRoles(): ?SharedRoles
    {
        return $this->sharedRoles;
    }

    /**
     * @param SharedRoles|null $sharedRoles
     */
    public function setSharedRoles(?SharedRoles $sharedRoles): void
    {
        $this->sharedRoles = $sharedRoles;
    }

    /**
     * @return Collection
     */
    public function getSharedScopes(): Collection
    {
        return $this->sharedScopes;
    }

    /**
     * @param Collection $sharedScopes
     */
    public function setSharedScopes(Collection $sharedScopes): void
    {
        $this->sharedScopes = $sharedScopes;
    }

    // custom

    /**
     * @param SharedCustomers $sharedCustomers
     * @param array $roles
     */
    public function addSharedCustomersWithRoles(SharedCustomers $sharedCustomers, array $roles): void
    {
        $linked = new SharedUsersSharedCustomersRoles($this, $sharedCustomers, $roles);
        $this->getSharedCustomersRoles()->add($linked);
        $sharedCustomers->getSharedUsersRoles()->add($linked);
    }

    /**
     * @param SharedCustomers $sharedCustomers
     * @param array $roles
     */
    public function addSharedCustomersWithPartnerRoles(SharedCustomers $sharedCustomers, array $roles): void
    {
        $linked = new SharedUsersSharedCustomersPartnerRoles($this, $sharedCustomers, $roles);
        $this->getSharedCustomersPartnerRoles()->add($linked);
        $sharedCustomers->getSharedUsersPartnerRoles()->add($linked);
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
