<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Tomato;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;
use Hedera\Models\SharedCustomersServices;

/**
 * @OGM\Node(label="TomatoCustomersConfigs", repository="Hedera\Repositories\Tomato\TomatoCustomersConfigsRepository")
 */
class TomatoCustomersConfigs implements \JsonSerializable
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
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $isGlobal;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $owner;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $sender;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $packageInfo;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $recipient;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $autoMoving;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $additionalServices;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="TOMATO_SERVICE_IN", direction="OUTGOING", collection=false, targetEntity="Hedera\Models\SharedCustomersServices")
     */
    protected $sharedCustomersServices;

    /**
     * @var TomatoTokensConfigs|null
     *
     * @OGM\Relationship(type="TOMATO_TOKEN_IN", direction="OUTGOING", collection=false, mappedBy="tomatoCustomersConfigs", targetEntity="TomatoTokensConfigs")
     */
    protected $tomatoTokensConfigs;

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
    public function isGlobal(): bool
    {
        return $this->isGlobal;
    }

    /**
     * @param bool $isGlobal
     */
    public function setIsGlobal(bool $isGlobal): void
    {
        $this->isGlobal = $isGlobal;
    }

    /**
     * @return string|null
     */
    public function getOwner(): ?string
    {
        return $this->owner;
    }

    /**
     * @param string|null $owner
     */
    public function setOwner(?string $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     */
    public function setSender($sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getPackageInfo()
    {
        return $this->packageInfo;
    }

    /**
     * @param mixed $packageInfo
     */
    public function setPackageInfo($packageInfo): void
    {
        $this->packageInfo = $packageInfo;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param mixed $recipient
     */
    public function setRecipient($recipient): void
    {
        $this->recipient = $recipient;
    }

    /**
     * @return mixed
     */
    public function getAutoMoving()
    {
        return $this->autoMoving;
    }

    /**
     * @param mixed $autoMoving
     */
    public function setAutoMoving($autoMoving): void
    {
        $this->autoMoving = $autoMoving;
    }

    /**
     * @return mixed
     */
    public function getAdditionalServices()
    {
        return $this->additionalServices;
    }

    /**
     * @param mixed $additionalServices
     */
    public function setAdditionalServices($additionalServices): void
    {
        $this->additionalServices = $additionalServices;
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
     * @return TomatoTokensConfigs|null
     */
    public function getTomatoTokensConfigs(): ?TomatoTokensConfigs
    {
        return $this->tomatoTokensConfigs;
    }

    /**
     * @param TomatoTokensConfigs|null $tomatoTokensConfigs
     */
    public function setTomatoTokensConfigs(?TomatoTokensConfigs $tomatoTokensConfigs): void
    {
        $this->tomatoTokensConfigs = $tomatoTokensConfigs;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
