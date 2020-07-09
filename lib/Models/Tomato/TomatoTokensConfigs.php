<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Tomato;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Helpers\SerializationHelper;
use Hedera\Models\SharedCustomersServices;

/**
 * @OGM\Node(label="TomatoTokensConfigs", repository="Hedera\Repositories\Tomato\TomatoTokensConfigsRepository")
 */
class TomatoTokensConfigs implements \JsonSerializable
{
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
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $isDefault;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $status;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $active;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $token;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $number;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="TOMATO_TOKEN_IN", direction="INCOMING", collection=true, mappedBy="tomatoTokensConfigs", targetEntity="TomatoCustomersConfigs")
     */
    protected $tomatoCustomersConfigs;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="TOMATO_TOKEN_ID_IN", direction="INCOMING", collection=true, mappedBy="tomatoTokensConfigs", targetEntity="TomatoInternetDocuments")
     */
    protected $tomatoInternetDocuments;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="TOMATO_SERVICE_IN", direction="OUTGOING", collection=false, targetEntity="Hedera\Models\SharedCustomersServices")
     */
    protected $sharedCustomersServices;

    public function __construct()
    {
        $this->tomatoCustomersConfigs = new HederaCollection();
        $this->tomatoInternetDocuments = new HederaCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault(bool $isDefault): void
    {
        $this->isDefault = $isDefault;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return SharedCustomersServices|null
     */
    public function getSharedCustomersServices(): ?SharedCustomersServices
    {
        return $this->sharedCustomersServices;
    }

    /**
     * @param SharedCustomersServices|null $sharedCustomersServices
     */
    public function setSharedCustomersServices(?SharedCustomersServices $sharedCustomersServices): void
    {
        $this->sharedCustomersServices = $sharedCustomersServices;
    }

    /**
     * @return Collection
     */
    public function getTomatoCustomersConfigs(): Collection
    {
        return $this->tomatoCustomersConfigs;
    }

    /**
     * @param Collection $tomatoCustomersConfigs
     */
    public function setTomatoCustomersConfigs(Collection $tomatoCustomersConfigs): void
    {
        $this->tomatoCustomersConfigs = $tomatoCustomersConfigs;
    }

    /**
     * @return Collection
     */
    public function getTomatoInternetDocuments(): Collection
    {
        return $this->tomatoInternetDocuments;
    }

    /**
     * @param Collection $tomatoInternetDocuments
     */
    public function setTomatoInternetDocuments(Collection $tomatoInternetDocuments): void
    {
        $this->tomatoInternetDocuments = $tomatoInternetDocuments;
    }

    public function jsonSerialize()
    {
        return self::serialize();
    }
}
