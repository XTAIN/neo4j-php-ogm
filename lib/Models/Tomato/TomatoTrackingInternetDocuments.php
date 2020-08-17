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
 * @OGM\Node(label="TomatoTrackingInternetDocuments", repository="Hedera\Repositories\Tomato\TomatoTrackingInternetDocumentsRepository")
 */
class TomatoTrackingInternetDocuments implements \JsonSerializable
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
    protected $number;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $status;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $statusCode;

    /**
     * @var TomatoInternetDocuments|null
     *
     * @OGM\Relationship(type="TOMATO_ID_TRACK_IN", direction="OUTGOING", collection=false, mappedBy="tomatoTrackingInternetDocuments", targetEntity="TomatoInternetDocuments")
     */
    protected $tomatoInternetDocument;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="TOMATO_TRACK_ID_IN", direction="INCOMING", collection=true, mappedBy="tomatoTrackingInternetDocuments", targetEntity="TomatoObserverConfigs")
     */
    protected $tomatoObserverConfigs;

    public function __construct()
    {
        $this->tomatoObserverConfigs = new HederaCollection();
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
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string|null $number
     */
    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    /**
     * @param string $statusCode
     */
    public function setStatusCode(string $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return TomatoInternetDocuments|null
     */
    public function getTomatoInternetDocument(): ?TomatoInternetDocuments
    {
        return $this->tomatoInternetDocument;
    }

    /**
     * @param TomatoInternetDocuments|null $tomatoInternetDocument
     */
    public function setTomatoInternetDocument(?TomatoInternetDocuments $tomatoInternetDocument): void
    {
        $this->tomatoInternetDocument = $tomatoInternetDocument;
    }

    /**
     * @return Collection
     */
    public function getTomatoObserverConfigs(): Collection
    {
        return $this->tomatoObserverConfigs;
    }

    /**
     * @param Collection $tomatoObserverConfigs
     */
    public function setTomatoObserverConfigs(Collection $tomatoObserverConfigs): void
    {
        $this->tomatoObserverConfigs = $tomatoObserverConfigs;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
