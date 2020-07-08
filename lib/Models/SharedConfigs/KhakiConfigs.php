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
class KhakiConfigs extends SharedConfigs
{
    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $partnersSettings;

    /**
     * @return mixed
     */
    public function getPartnersSettings()
    {
        return $this->partnersSettings;
    }

    /**
     * @param mixed $partnersSettings
     */
    public function setPartnersSettings($partnersSettings): void
    {
        $this->partnersSettings = $partnersSettings;
    }
}
