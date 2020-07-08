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

/**
 * @OGM\Node(label="SharedAmocrmLicensesCost", repository="Hedera\Repositories\SharedAmocrmLicensesCostRepository")
 */
class SharedAmocrmLicensesCost
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var string
     *
     * @OGM\Property(type="string", key="tariff_name")
     */
    protected $tariffName;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", key="tariff_cost")
     * @OGM\Convert(type="nested")
     */
    protected $tariffCost;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $limits;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="LICENSE_COST_IN", direction="INCOMING", collection=true, mappedBy="sharedAmocrmLicensesCost", targetEntity="SharedAmocrmLicenses")
     */
    protected $sharedAmocrmLicenses;

    public function __construct()
    {
        $this->sharedAmocrmLicenses = new HederaCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getTariffCost()
    {
        return $this->tariffCost;
    }

    /**
     * @param mixed $tariffCost
     */
    public function setTariffCost($tariffCost): void
    {
        $this->tariffCost = $tariffCost;
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
     * @return Collection
     */
    public function getSharedAmocrmLicenses(): Collection
    {
        return $this->sharedAmocrmLicenses;
    }

    /**
     * @param Collection $sharedAmocrmLicenses
     */
    public function setSharedAmocrmLicenses(Collection $sharedAmocrmLicenses): void
    {
        $this->sharedAmocrmLicenses = $sharedAmocrmLicenses;
    }
}
