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
 * @OGM\Node(label="TomatoTrackingInternetDocuments", repository="Hedera\Repositories\Tomato\TomatoTrackingInternetDocumentsRepository")
 */
class TomatoTrackingInternetDocuments
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
    protected $Number;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $Status;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $StatusCode;

    /**
     * @var TomatoInternetDocuments|null
     *
     * @OGM\Relationship(type="TOMATO_ID_TRACK_IN", direction="OUTGOING", collection=false, mappedBy="tomatoTrackingInternetDocuments" targetEntity="TomatoInternetDocuments")
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
        return $this->Number;
    }

    /**
     * @param string|null $Number
     */
    public function setNumber(?string $Number): void
    {
        $this->Number = $Number;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->Status;
    }

    /**
     * @param string $Status
     */
    public function setStatus(string $Status): void
    {
        $this->Status = $Status;
    }

    /**
     * @return string
     */
    public function getStatusCode(): string
    {
        return $this->StatusCode;
    }

    /**
     * @param string $StatusCode
     */
    public function setStatusCode(string $StatusCode): void
    {
        $this->StatusCode = $StatusCode;
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
}
