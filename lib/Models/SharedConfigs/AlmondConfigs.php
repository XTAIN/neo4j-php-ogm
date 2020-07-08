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
class AlmondConfigs extends SharedConfigs
{
    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $rules;

    /**
     * @return array
     */
    public function getRules(): ?array
    {
        return $this->rules;
    }

    /**
     * @param array $rules
     */
    public function setRules(?array $rules): void
    {
        $this->rules = $rules;
    }
}
