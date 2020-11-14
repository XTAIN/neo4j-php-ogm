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

/**
 * @OGM\Node(label="SharedModules", repository="Hedera\Repositories\SharedModulesRepository")
 */
class SharedModules implements \JsonSerializable
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
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $power;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $code;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $key;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="array")
     */
    protected $availableCondact;

    /**
     * @var SharedCustomers|null
     *
     * @OGM\Relationship(type="MODULE_CU_IN", direction="OUTGOING", collection=false, mappedBy="sharedModules", targetEntity="SharedCustomers")
     */
    protected $sharedCustomers;

    /**
     * @var SharedConfigs|null
     *
     * @OGM\Relationship(type="MODULE_CONFIG_IN", direction="INCOMING", collection=false, mappedBy="sharedModules", targetEntity="SharedConfigs")
     */
    protected $sharedConfigs;

    /**
     * @var SharedAmocrm|null
     *
     * @OGM\Relationship(type="AMOCRM_MODULE_IN", direction="INCOMING", collection=false, mappedBy="sharedModules", targetEntity="SharedAmocrm")
     */
    protected $sharedAmocrm;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="LIME_MOD_CONVERT_IN", direction="INCOMING", collection=true, mappedBy="sharedModules", targetEntity="Hedera\Models\Lime\LimeConvert")
     */
    protected $limeConvert;

    public function __construct()
    {
        $this->limeConvert = new HederaCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isPower(): bool
    {
        return $this->power;
    }

    /**
     * @param bool $power
     */
    public function setPower(bool $power): void
    {
        $this->power = $power;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return array|null
     */
    public function getAvailableCondact(): ?array
    {
        return $this->availableCondact;
    }

    /**
     * @param array|null $availableCondact
     */
    public function setAvailableCondact(?array $availableCondact): void
    {
        $this->availableCondact = $availableCondact;
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
     * @return SharedConfigs|null
     */
    public function getSharedConfigs(): ?SharedConfigs
    {
        return $this->sharedConfigs;
    }

    /**
     * @param SharedConfigs|null $sharedConfigs
     */
    public function setSharedConfigs(?SharedConfigs $sharedConfigs): void
    {
        $this->sharedConfigs = $sharedConfigs;
    }

    /**
     * @return SharedAmocrm|null
     */
    public function getSharedAmocrm(): ?SharedAmocrm
    {
        return $this->sharedAmocrm;
    }

    /**
     * @param SharedAmocrm|null $sharedAmocrm
     */
    public function setSharedAmocrm(?SharedAmocrm $sharedAmocrm): void
    {
        $this->sharedAmocrm = $sharedAmocrm;
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

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
