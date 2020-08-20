<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.08.19
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\SharedConfigs;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Models\SharedConfigs;

/**
 * @OGM\Node(label="SharedConfigs", repository="Hedera\Repositories\SharedConfigsRepository")
 */
class DianthusConfigs extends SharedConfigs
{
    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $name;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $key;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $secret;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $companyId;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="DIANTHUS_BLACKCONFIG", direction="INCOMING", collection=true, mappedBy="dianthusConfigs", targetEntity="Hedera\Models\SharedConfigs\BlackConfigs")
     */
    protected $blackConfigs;

    public function __construct()
    {
        parent::__construct();
        $this->blackConfigs = new HederaCollection();
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
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey(?string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return string|null
     */
    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * @param string|null $secret
     */
    public function setSecret(?string $secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @return string|null
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }

    /**
     * @param string|null $companyId
     */
    public function setCompanyId(?string $companyId): void
    {
        $this->companyId = $companyId;
    }

    /**
     * @return Collection
     */
    public function getBlackConfigs(): Collection
    {
        return $this->blackConfigs;
    }

    /**
     * @param Collection $blackConfigs
     */
    public function setBlackConfigs(Collection $blackConfigs): void
    {
        $this->blackConfigs = $blackConfigs;
    }
}
