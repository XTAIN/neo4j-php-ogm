<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
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
class BlackConfigs extends SharedConfigs
{
    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $mode;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $entry;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="BLACK_CONFIG_IN", direction="INCOMING", collection=true, mappedBy="blackConfigs", targetEntity="Hedera\Models\BlackRelationFields")
     */
    protected $blackRelationConfigs;

    public function __construct()
    {
        parent::__construct();
        $this->blackRelationConfigs = new HederaCollection();
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
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     */
    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }

    /**
     * @return string
     */
    public function getEntry(): string
    {
        return $this->entry;
    }

    /**
     * @param string $entry
     */
    public function setEntry(string $entry): void
    {
        $this->entry = $entry;
    }

    /**
     * @return Collection
     */
    public function getBlackRelationConfigs(): Collection
    {
        return $this->blackRelationConfigs;
    }

    /**
     * @param Collection $blackRelationConfigs
     */
    public function setBlackRelationConfigs(Collection $blackRelationConfigs): void
    {
        $this->blackRelationConfigs = $blackRelationConfigs;
    }
}
