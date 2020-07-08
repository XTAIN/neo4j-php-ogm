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

/**
 * @OGM\Node(label="TomatoFrontInternetDocuments", repository="Hedera\Repositories\Tomato\TomatoFrontInternetDocumentsRepository")
 */
class TomatoFrontInternetDocuments
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int")
     */
    protected $leadId;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $accountUuid;

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
    protected $additionalServices;

    /**
     * @var TomatoInternetDocuments|null
     *
     * @OGM\Relationship(type="TOMATO_ID_FRONT_IN", direction="OUTGOING", collection=false, mappedBy="tomatoFrontInternetDocuments", targetEntity="TomatoInternetDocuments")
     */
    protected $tomatoInternetDocument;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getLeadId(): ?int
    {
        return $this->leadId;
    }

    /**
     * @param int|null $leadId
     */
    public function setLeadId(?int $leadId): void
    {
        $this->leadId = $leadId;
    }

    /**
     * @return string
     */
    public function getAccountUuid(): string
    {
        return $this->accountUuid;
    }

    /**
     * @param string $accountUuid
     */
    public function setAccountUuid(string $accountUuid): void
    {
        $this->accountUuid = $accountUuid;
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
}
