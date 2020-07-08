<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\SharedConfigs;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Models\SharedConfigs;

/**
 * @OGM\Node(label="SharedConfigs", repository="Hedera\Repositories\SharedConfigsRepository")
 */
class AmberConfigs extends SharedConfigs
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
     * @OGM\Property(type="string", key="tracking_id")
     */
    protected $trackingId;

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
    public function getTrackingId(): string
    {
        return $this->trackingId;
    }

    /**
     * @param string $trackingId
     */
    public function setTrackingId(string $trackingId): void
    {
        $this->trackingId = $trackingId;
    }
}
