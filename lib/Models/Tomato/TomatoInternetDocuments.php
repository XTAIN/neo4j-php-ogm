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

/**
 * @OGM\Node(label="TomatoInternetDocuments", repository="Hedera\Repositories\Tomato\TomatoInternetDocumentsRepository")
 */
class TomatoInternetDocuments
{
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
    protected $IntDocNumber;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $DateTime;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $Ref;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $Description;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $ServiceType;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $Cost;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $CostOnSite;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $SendersPhone;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $RecipientsPhone;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $StateName;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $SenderDescription;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $RecipientDescription;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $SenderAddressDescription;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $RecipientAddressDescription;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $EstimatedDeliveryDate;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $DateLastUpdatedStatus;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $CreateTime;

    /**
     * @var TomatoTokensConfigs|null
     *
     * @OGM\Relationship(type="TOMATO_TOKEN_ID_IN", direction="OUTGOING", collection=false, mappedBy="tomatoInternetDocuments" targetEntity="TomatoTokensConfigs")
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
        return $this->IntDocNumber;
    }

    /**
     * @param string|null $IntDocNumber
     */
    public function setIntDocNumber(?string $IntDocNumber): void
    {
        $this->IntDocNumber = $IntDocNumber;
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->DateTime;
    }

    /**
     * @param string $DateTime
     */
    public function setDateTime(string $DateTime): void
    {
        $this->DateTime = $DateTime;
    }

    /**
     * @return string
     */
    public function getRef(): string
    {
        return $this->Ref;
    }

    /**
     * @param string $Ref
     */
    public function setRef(string $Ref): void
    {
        $this->Ref = $Ref;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     */
    public function setDescription(string $Description): void
    {
        $this->Description = $Description;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->ServiceType;
    }

    /**
     * @param string $ServiceType
     */
    public function setServiceType(string $ServiceType): void
    {
        $this->ServiceType = $ServiceType;
    }

    /**
     * @return string
     */
    public function getCost(): string
    {
        return $this->Cost;
    }

    /**
     * @param string $Cost
     */
    public function setCost(string $Cost): void
    {
        $this->Cost = $Cost;
    }

    /**
     * @return string
     */
    public function getCostOnSite(): string
    {
        return $this->CostOnSite;
    }

    /**
     * @param string $CostOnSite
     */
    public function setCostOnSite(string $CostOnSite): void
    {
        $this->CostOnSite = $CostOnSite;
    }

    /**
     * @return string|null
     */
    public function getSendersPhone(): ?string
    {
        return $this->SendersPhone;
    }

    /**
     * @param string|null $SendersPhone
     */
    public function setSendersPhone(?string $SendersPhone): void
    {
        $this->SendersPhone = $SendersPhone;
    }

    /**
     * @return string|null
     */
    public function getRecipientsPhone(): ?string
    {
        return $this->RecipientsPhone;
    }

    /**
     * @param string|null $RecipientsPhone
     */
    public function setRecipientsPhone(?string $RecipientsPhone): void
    {
        $this->RecipientsPhone = $RecipientsPhone;
    }

    /**
     * @return string|null
     */
    public function getStateName(): ?string
    {
        return $this->StateName;
    }

    /**
     * @param string|null $StateName
     */
    public function setStateName(?string $StateName): void
    {
        $this->StateName = $StateName;
    }

    /**
     * @return string|null
     */
    public function getSenderDescription(): ?string
    {
        return $this->SenderDescription;
    }

    /**
     * @param string|null $SenderDescription
     */
    public function setSenderDescription(?string $SenderDescription): void
    {
        $this->SenderDescription = $SenderDescription;
    }

    /**
     * @return string|null
     */
    public function getRecipientDescription(): ?string
    {
        return $this->RecipientDescription;
    }

    /**
     * @param string|null $RecipientDescription
     */
    public function setRecipientDescription(?string $RecipientDescription): void
    {
        $this->RecipientDescription = $RecipientDescription;
    }

    /**
     * @return string|null
     */
    public function getSenderAddressDescription(): ?string
    {
        return $this->SenderAddressDescription;
    }

    /**
     * @param string|null $SenderAddressDescription
     */
    public function setSenderAddressDescription(?string $SenderAddressDescription): void
    {
        $this->SenderAddressDescription = $SenderAddressDescription;
    }

    /**
     * @return string|null
     */
    public function getRecipientAddressDescription(): ?string
    {
        return $this->RecipientAddressDescription;
    }

    /**
     * @param string|null $RecipientAddressDescription
     */
    public function setRecipientAddressDescription(?string $RecipientAddressDescription): void
    {
        $this->RecipientAddressDescription = $RecipientAddressDescription;
    }

    /**
     * @return string|null
     */
    public function getEstimatedDeliveryDate(): ?string
    {
        return $this->EstimatedDeliveryDate;
    }

    /**
     * @param string|null $EstimatedDeliveryDate
     */
    public function setEstimatedDeliveryDate(?string $EstimatedDeliveryDate): void
    {
        $this->EstimatedDeliveryDate = $EstimatedDeliveryDate;
    }

    /**
     * @return string|null
     */
    public function getDateLastUpdatedStatus(): ?string
    {
        return $this->DateLastUpdatedStatus;
    }

    /**
     * @param string|null $DateLastUpdatedStatus
     */
    public function setDateLastUpdatedStatus(?string $DateLastUpdatedStatus): void
    {
        $this->DateLastUpdatedStatus = $DateLastUpdatedStatus;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->CreateTime;
    }

    /**
     * @param string|null $CreateTime
     */
    public function setCreateTime(?string $CreateTime): void
    {
        $this->CreateTime = $CreateTime;
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
}
