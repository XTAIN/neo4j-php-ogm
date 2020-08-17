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
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="TomatoInternetDocuments", repository="Hedera\Repositories\Tomato\TomatoInternetDocumentsRepository")
 */
class TomatoInternetDocuments implements \JsonSerializable
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
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $intDocNumber;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $dateTime;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $ref;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $description;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $serviceType;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $cost;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $costOnSite;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $sendersPhone;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $recipientsPhone;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $stateName;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $senderDescription;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $recipientDescription;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $senderAddressDescription;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $recipientAddressDescription;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $estimatedDeliveryDate;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $dateLastUpdatedStatus;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $createTime;

    /**
     * @var TomatoTokensConfigs|null
     *
     * @OGM\Relationship(type="TOMATO_TOKEN_ID_IN", direction="OUTGOING", collection=false, mappedBy="tomatoInternetDocuments", targetEntity="TomatoTokensConfigs")
     */
    protected $tomatoTokensConfigs;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="TOMATO_ID_TRACK_IN", direction="INCOMING", collection=true, mappedBy="tomatoInternetDocument", targetEntity="TomatoTrackingInternetDocuments")
     */
    protected $tomatoTrackingInternetDocuments;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="TOMATO_ID_FRONT_IN", direction="INCOMING", collection=true, mappedBy="tomatoInternetDocument", targetEntity="TomatoFrontInternetDocuments")
     */
    protected $tomatoFrontInternetDocuments;

    public function __construct()
    {
        $this->tomatoTrackingInternetDocuments = new HederaCollection();
        $this->tomatoFrontInternetDocuments = new HederaCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getIntDocNumber(): ?string
    {
        return $this->intDocNumber;
    }

    /**
     * @param string|null $intDocNumber
     */
    public function setIntDocNumber(?string $intDocNumber): void
    {
        $this->intDocNumber = $intDocNumber;
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * @param string $dateTime
     */
    public function setDateTime(string $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * @param string $ref
     */
    public function setRef(string $ref): void
    {
        $this->ref = $ref;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * @param string $serviceType
     */
    public function setServiceType(string $serviceType): void
    {
        $this->serviceType = $serviceType;
    }

    /**
     * @return string
     */
    public function getCost(): string
    {
        return $this->cost;
    }

    /**
     * @param string $cost
     */
    public function setCost(string $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return string
     */
    public function getCostOnSite(): string
    {
        return $this->costOnSite;
    }

    /**
     * @param string $costOnSite
     */
    public function setCostOnSite(string $costOnSite): void
    {
        $this->costOnSite = $costOnSite;
    }

    /**
     * @return string|null
     */
    public function getSendersPhone(): ?string
    {
        return $this->sendersPhone;
    }

    /**
     * @param string|null $sendersPhone
     */
    public function setSendersPhone(?string $sendersPhone): void
    {
        $this->sendersPhone = $sendersPhone;
    }

    /**
     * @return string|null
     */
    public function getRecipientsPhone(): ?string
    {
        return $this->recipientsPhone;
    }

    /**
     * @param string|null $recipientsPhone
     */
    public function setRecipientsPhone(?string $recipientsPhone): void
    {
        $this->recipientsPhone = $recipientsPhone;
    }

    /**
     * @return string|null
     */
    public function getStateName(): ?string
    {
        return $this->stateName;
    }

    /**
     * @param string|null $stateName
     */
    public function setStateName(?string $stateName): void
    {
        $this->stateName = $stateName;
    }

    /**
     * @return string|null
     */
    public function getSenderDescription(): ?string
    {
        return $this->senderDescription;
    }

    /**
     * @param string|null $senderDescription
     */
    public function setSenderDescription(?string $senderDescription): void
    {
        $this->senderDescription = $senderDescription;
    }

    /**
     * @return string|null
     */
    public function getRecipientDescription(): ?string
    {
        return $this->recipientDescription;
    }

    /**
     * @param string|null $recipientDescription
     */
    public function setRecipientDescription(?string $recipientDescription): void
    {
        $this->recipientDescription = $recipientDescription;
    }

    /**
     * @return string|null
     */
    public function getSenderAddressDescription(): ?string
    {
        return $this->senderAddressDescription;
    }

    /**
     * @param string|null $senderAddressDescription
     */
    public function setSenderAddressDescription(?string $senderAddressDescription): void
    {
        $this->senderAddressDescription = $senderAddressDescription;
    }

    /**
     * @return string|null
     */
    public function getRecipientAddressDescription(): ?string
    {
        return $this->recipientAddressDescription;
    }

    /**
     * @param string|null $recipientAddressDescription
     */
    public function setRecipientAddressDescription(?string $recipientAddressDescription): void
    {
        $this->recipientAddressDescription = $recipientAddressDescription;
    }

    /**
     * @return string|null
     */
    public function getEstimatedDeliveryDate(): ?string
    {
        return $this->estimatedDeliveryDate;
    }

    /**
     * @param string|null $estimatedDeliveryDate
     */
    public function setEstimatedDeliveryDate(?string $estimatedDeliveryDate): void
    {
        $this->estimatedDeliveryDate = $estimatedDeliveryDate;
    }

    /**
     * @return string|null
     */
    public function getDateLastUpdatedStatus(): ?string
    {
        return $this->dateLastUpdatedStatus;
    }

    /**
     * @param string|null $dateLastUpdatedStatus
     */
    public function setDateLastUpdatedStatus(?string $dateLastUpdatedStatus): void
    {
        $this->dateLastUpdatedStatus = $dateLastUpdatedStatus;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

    /**
     * @param string|null $createTime
     */
    public function setCreateTime(?string $createTime): void
    {
        $this->createTime = $createTime;
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

    /**
     * @return Collection
     */
    public function getTomatoTrackingInternetDocuments(): Collection
    {
        return $this->tomatoTrackingInternetDocuments;
    }

    /**
     * @param Collection $tomatoTrackingInternetDocuments
     */
    public function setTomatoTrackingInternetDocuments(Collection $tomatoTrackingInternetDocuments): void
    {
        $this->tomatoTrackingInternetDocuments = $tomatoTrackingInternetDocuments;
    }

    /**
     * @return Collection
     */
    public function getTomatoFrontInternetDocuments(): Collection
    {
        return $this->tomatoFrontInternetDocuments;
    }

    /**
     * @param Collection $tomatoFrontInternetDocuments
     */
    public function setTomatoFrontInternetDocuments(Collection $tomatoFrontInternetDocuments): void
    {
        $this->tomatoFrontInternetDocuments = $tomatoFrontInternetDocuments;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
