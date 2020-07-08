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

/**
 * @OGM\Node(label="SharedCustomers", repository="Hedera\Repositories\SharedCustomersRepository")
 */
class SharedCustomers implements \JsonSerializable
{
    use EntityFactory;
    use SerializationHelper;

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
     * @var Collection
     *
     * @OGM\Relationship(type="CUSTOMER_SERVICE_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="SharedCustomersServices")
     */
    protected $sharedCustomersServices;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="AMOCRM_CU_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="SharedAmocrm")
     */
    protected $sharedAmocrm;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="LIME_RULES_CU_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="LimeRules")
     */
    protected $limeRules;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="LIME_CONVERT_CU_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="LimeConvert")
     */
    protected $limeConvert;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="MODULE_CU_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomers", targetEntity="SharedModules")
     */
    protected $sharedModules;

    public function __construct()
    {
        $this->sharedCustomersServices = new HederaCollection();
        $this->sharedAmocrm = new HederaCollection();
        $this->limeRules = new HederaCollection();
        $this->limeConvert = new HederaCollection();
        $this->sharedModules = new HederaCollection();
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
     * @param string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
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

    public function jsonSerialize()
    {
        return self::serialize();
    }
}
