<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.08.04
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Relations;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\SerializationHelper;
use Hedera\Models\SharedMenu;

/**
 *
 * @OGM\RelationshipEntity(type="SUB_MENU")
 */
class SubMenu implements \JsonSerializable
{
    use SerializationHelper;

    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var SharedMenu
     *
     * @OGM\StartNode(targetEntity="Hedera\Models\SharedMenu")
     */
    protected $from;

    /**
     * @var SharedMenu
     *
     * @OGM\EndNode(targetEntity="Hedera\Models\SharedMenu")
     */
    protected $to;

    /**
     * @param SharedMenu $from
     * @param SharedMenu $to
     */
    public function __construct(SharedMenu $from, SharedMenu $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return SharedMenu
     */
    public function getFrom(): SharedMenu
    {
        return $this->from;
    }

    /**
     * @param SharedMenu $from
     */
    public function setFrom(SharedMenu $from): void
    {
        $this->from = $from;
    }

    /**
     * @return SharedMenu
     */
    public function getTo(): SharedMenu
    {
        return $this->to;
    }

    /**
     * @param SharedMenu $to
     */
    public function setTo(SharedMenu $to): void
    {
        $this->to = $to;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
