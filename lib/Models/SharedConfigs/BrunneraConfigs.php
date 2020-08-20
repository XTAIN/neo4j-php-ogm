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
class BrunneraConfigs extends SharedConfigs
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
    protected $domain;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $apiKey;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="BRUNNERA_BLACKCONFIG", direction="INCOMING", collection=true, mappedBy="brunneraConfigs", targetEntity="Hedera\Models\SharedConfigs\BlackConfigs")
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
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param string|null $domain
     */
    public function setDomain(?string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @param string|null $apiKey
     */
    public function setApiKey(?string $apiKey): void
    {
        $this->apiKey = $apiKey;
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
