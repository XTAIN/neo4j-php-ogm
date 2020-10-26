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
use Hedera\Helpers\SoftDeletes;
use Hedera\Relations\SharedUsersSharedCustomersPartnerRoles;
use Hedera\Relations\SharedUsersSharedCustomersRoles;

/**
 * @OGM\Node(label="SharedCustomers", repository="Hedera\Repositories\SharedCustomersRepository")
 */
class SharedCustomers implements \JsonSerializable
{
    use EntityFactory;
    use SerializationHelper;
    use SoftDeletes;

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
    protected $description;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $key;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean", nullable=true)
     */
    protected $disabled;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="CUSTOMER_SERVICE_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="Hedera\Models\SharedCustomersServices")
     */
    protected $sharedCustomersServices;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="AMOCRM_CU_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="Hedera\Models\SharedAmocrm")
     */
    protected $sharedAmocrm;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="LIME_RULES_CU_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="Hedera\Models\Lime\LimeRules")
     */
    protected $limeRules;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="LIME_CONVERT_CU_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="Hedera\Models\Lime\LimeConvert")
     */
    protected $limeConvert;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="MODULE_CU_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="Hedera\Models\SharedModules")
     */
    protected $sharedModules;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="MODULE_CONTACT_IN", direction="BOTH", collection=true, mappedBy="sharedCustomers", targetEntity="Hedera\Models\SharedContacts")
     */
    protected $sharedContacts;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="INTERMEDIA_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="Hedera\Models\SharedIntermediaries")
     */
    protected $sharedIntermediaries;

    /**
     * @var Collection<\Hedera\Relations\SharedUsersSharedCustomersRoles>
     *
     * @OGM\Relationship(relationshipEntity="Hedera\Relations\SharedUsersSharedCustomersRoles", type="SHARED_USERS_TO_SHARED_CUSTOMERS_ROLES", direction="INCOMING", collection=true, mappedBy="sharedCustomers")
     */
    protected $sharedUsersRoles;

    /**
     * @var Collection<\Hedera\Relations\SharedUsersSharedCustomersPartnerRoles>
     *
     * @OGM\Relationship(relationshipEntity="Hedera\Relations\SharedUsersSharedCustomersPartnerRoles", type="SHARED_USERS_TO_SHARED_CUSTOMERS_PARTNER_ROLES", direction="INCOMING", collection=true, mappedBy="sharedCustomers")
     */
    protected $sharedUsersPartnerRoles;

    public function __construct()
    {
        $this->sharedCustomersServices = new HederaCollection();
        $this->sharedAmocrm = new HederaCollection();
        $this->limeRules = new HederaCollection();
        $this->limeConvert = new HederaCollection();
        $this->sharedModules = new HederaCollection();
        $this->sharedContacts = new HederaCollection();
        $this->sharedIntermediaries = new HederaCollection();
        $this->sharedUsersRoles = new HederaCollection();
        $this->sharedUsersPartnerRoles = new HederaCollection();
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey(?string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return bool|null
     */
    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    /**
     * @param bool|null $disabled
     */
    public function setDisabled(?bool $disabled): void
    {
        $this->disabled = $disabled;
    }

    /**
     * @return Collection
     */
    public function getSharedCustomersServices(): Collection
    {
        return $this->sharedCustomersServices;
    }

    /**
     * @param Collection $sharedCustomerServices
     */
    public function setSharedCustomersServices(Collection $sharedCustomerServices): void
    {
        $this->sharedCustomersServices = $sharedCustomerServices;
    }

    /**
     * @return Collection
     */
    public function getSharedAmocrm(): Collection
    {
        return $this->sharedAmocrm;
    }

    /**
     * @param Collection $sharedAmocrm
     */
    public function setSharedAmocrm(Collection $sharedAmocrm): void
    {
        $this->sharedAmocrm = $sharedAmocrm;
    }

    /**
     * @return Collection
     */
    public function getLimeRules(): Collection
    {
        return $this->limeRules;
    }

    /**
     * @param Collection $limeRules
     */
    public function setLimeRules(Collection $limeRules): void
    {
        $this->limeRules = $limeRules;
    }

    /**
     * @return Collection
     */
    public function getLimeConvert(): Collection
    {
        return $this->limeConvert;
    }

    /**
     * @param Collection $limeConvert
     */
    public function setLimeConvert(Collection $limeConvert): void
    {
        $this->limeConvert = $limeConvert;
    }

    /**
     * @return Collection
     */
    public function getSharedModules(): Collection
    {
        return $this->sharedModules;
    }

    /**
     * @param Collection $sharedModules
     */
    public function setSharedModules(Collection $sharedModules): void
    {
        $this->sharedModules = $sharedModules;
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
    public function getSharedIntermediaries(): Collection
    {
        return $this->sharedIntermediaries;
    }

    /**
     * @param Collection $sharedIntermediaries
     */
    public function setSharedIntermediaries(Collection $sharedIntermediaries): void
    {
        $this->sharedIntermediaries = $sharedIntermediaries;
    }

    /**
     * @return Collection
     */
    public function getSharedUsersRoles(): Collection
    {
        return $this->sharedUsersRoles;
    }

    /**
     * @param Collection $sharedUsersRoles
     */
    public function setSharedUsersRoles(Collection $sharedUsersRoles): void
    {
        $this->sharedUsersRoles = $sharedUsersRoles;
    }

    /**
     * @return Collection
     */
    public function getSharedUsersPartnerRoles(): Collection
    {
        return $this->sharedUsersPartnerRoles;
    }

    /**
     * @param Collection $sharedUsersPartnerRoles
     */
    public function setSharedUsersPartnerRoles(Collection $sharedUsersPartnerRoles): void
    {
        $this->sharedUsersPartnerRoles = $sharedUsersPartnerRoles;
    }

    // custom

    /**
     * @param SharedUsers $sharedUsers
     * @param array $roles
     */
    public function addSharedCustomersWithRoles(SharedUsers $sharedUsers, array $roles): void
    {
        $linked = new SharedUsersSharedCustomersRoles($sharedUsers, $this, $roles);
        $this->getSharedUsersRoles()->add($linked);
        $sharedUsers->getSharedCustomersRoles()->add($linked);
    }

    /**
     * @param SharedUsers $sharedUsers
     * @param array $roles
     */
    public function addSharedCustomersWithPartnerRoles(SharedUsers $sharedUsers, array $roles): void
    {
        $linked = new SharedUsersSharedCustomersPartnerRoles($sharedUsers, $this, $roles);
        $this->getSharedUsersPartnerRoles()->add($linked);
        $sharedUsers->getSharedCustomersPartnerRoles()->add($linked);
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
