<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="SharedAmocrmLicenses", repository="Hedera\Repositories\SharedAmocrmLicensesRepository")
 */
class SharedAmocrmLicenses
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean", key="subscription_active")
     */
    protected $subscriptionActive;

    /**
     * @var int
     *
     * @OGM\Property(type="int", key="tariff_id")
     */
    protected $tariffId;

    /**
     * @var string
     *
     * @OGM\Property(type="string", key="tariff_name")
     */
    protected $tariffName;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $detail;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $limits;

    /**
     * @var SharedAmocrmLicensesCost|null
     *
     * @OGM\Relationship(type="LICENSE_COST_IN", direction="OUTGOING", collection=false, mappedBy="sharedAmocrmLicenses", targetEntity="SharedAmocrmLicensesCost")
     */
    protected $sharedAmocrmLicensesCost;

    /**
     * @var SharedAmocrm|null
     *
     * @OGM\Relationship(type="AMOCRM_LICENSE_IN", direction="INCOMING", collection=false, mappedBy="sharedAmocrmLicenses", targetEntity="SharedAmocrm")
     */
    protected $sharedAmocrm;

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
     * @return bool
     */
    public function isSubscriptionActive(): bool
    {
        return $this->subscriptionActive;
    }

    /**
     * @param bool $subscriptionActive
     */
    public function setSubscriptionActive(bool $subscriptionActive): void
    {
        $this->subscriptionActive = $subscriptionActive;
    }

    /**
     * @return int
     */
    public function getTariffId(): int
    {
        return $this->tariffId;
    }

    /**
     * @param int $tariffId
     */
    public function setTariffId(int $tariffId): void
    {
        $this->tariffId = $tariffId;
    }

    /**
     * @return string
     */
    public function getTariffName(): string
    {
        return $this->tariffName;
    }

    /**
     * @param string $tariffName
     */
    public function setTariffName(string $tariffName): void
    {
        $this->tariffName = $tariffName;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getLimits()
    {
        return $this->limits;
    }

    /**
     * @param mixed $limits
     */
    public function setLimits($limits): void
    {
        $this->limits = $limits;
    }

    /**
     * @return SharedAmocrmLicensesCost|null
     */
    public function getSharedAmocrmLicensesCost(): ?SharedAmocrmLicensesCost
    {
        return $this->sharedAmocrmLicensesCost;
    }

    /**
     * @param SharedAmocrmLicensesCost|null $sharedAmocrmLicensesCost
     */
    public function setSharedAmocrmLicensesCost(?SharedAmocrmLicensesCost $sharedAmocrmLicensesCost): void
    {
        $this->sharedAmocrmLicensesCost = $sharedAmocrmLicensesCost;
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

}
