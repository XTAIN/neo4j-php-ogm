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
use Hedera\Helpers\SerializationHelper;
use Hedera\Models\SharedCustomersServices;

/**
 * @OGM\Node(label="TomatoObserverConfigs", repository="Hedera\Repositories\Tomato\TomatoObserverConfigsRepository")
 */
class TomatoObserverConfigs implements \JsonSerializable
{
    use SerializationHelper;

    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $leadId;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $internetDocumentNumber;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $observing;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="TOMATO_SERVICE_IN", direction="OUTGOING", collection=false, targetEntity="Hedera\Models\SharedCustomersServices")
     */
    protected $sharedCustomersServices;

    /**
     * @var TomatoTrackingInternetDocuments|null
     *
     * @OGM\Relationship(type="TOMATO_TRACK_ID_IN", direction="OUTGOING", collection=false, mappedBy="tomatoObserverConfigs", targetEntity="TomatoTrackingInternetDocuments")
     */
    protected $tomatoTrackingInternetDocuments;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLeadId(): int
    {
        return $this->leadId;
    }

    /**
     * @param int $leadId
     */
    public function setLeadId(int $leadId): void
    {
        $this->leadId = $leadId;
    }

    /**
     * @return string
     */
    public function getInternetDocumentNumber(): string
    {
        return $this->internetDocumentNumber;
    }

    /**
     * @param string $internetDocumentNumber
     */
    public function setInternetDocumentNumber(string $internetDocumentNumber): void
    {
        $this->internetDocumentNumber = $internetDocumentNumber;
    }

    /**
     * @return bool
     */
    public function isObserving(): bool
    {
        return $this->observing;
    }

    /**
     * @param bool $observing
     */
    public function setObserving(bool $observing): void
    {
        $this->observing = $observing;
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
     * @return TomatoTrackingInternetDocuments|null
     */
    public function getTomatoTrackingInternetDocuments(): ?TomatoTrackingInternetDocuments
    {
        return $this->tomatoTrackingInternetDocuments;
    }

    /**
     * @param TomatoTrackingInternetDocuments|null $tomatoTrackingInternetDocuments
     */
    public function setTomatoTrackingInternetDocuments(
        ?TomatoTrackingInternetDocuments $tomatoTrackingInternetDocuments
    ): void {
        $this->tomatoTrackingInternetDocuments = $tomatoTrackingInternetDocuments;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
