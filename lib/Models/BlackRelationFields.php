<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Models\SharedConfigs\BlackConfigs;

/**
 * @OGM\Node(label="BlackRelationFields", repository="Hedera\Repositories\BlackRelationFieldsRepository")
 */
class BlackRelationFields
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $enterItem;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $intermediaryItem;

    /**
     * @var BlackConfigs|null
     *
     * @OGM\Relationship(type="BLACK_CONFIG_IN", direction="OUTGOING", collection=false, mappedBy="blackRelationConfigs", targetEntity="Hedera\Models\SharedConfigs\BlackConfigs")
     */
    protected $blackConfigs;

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
     * @return mixed
     */
    public function getEnterItem()
    {
        return $this->enterItem;
    }

    /**
     * @param mixed $enterItem
     */
    public function setEnterItem($enterItem): void
    {
        $this->enterItem = $enterItem;
    }

    /**
     * @return mixed
     */
    public function getIntermediaryItem()
    {
        return $this->intermediaryItem;
    }

    /**
     * @param mixed $intermediaryItem
     */
    public function setIntermediaryItem($intermediaryItem): void
    {
        $this->intermediaryItem = $intermediaryItem;
    }

    /**
     * @return BlackConfigs|null
     */
    public function getBlackConfigs(): ?BlackConfigs
    {
        return $this->blackConfigs;
    }

    /**
     * @param BlackConfigs|null $blackConfigs
     */
    public function setBlackConfigs(?BlackConfigs $blackConfigs): void
    {
        $this->blackConfigs = $blackConfigs;
    }
}
