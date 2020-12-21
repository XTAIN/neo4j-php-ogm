<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.12.21
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Google;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="SharedConfigs", repository="Hedera\Repositories\SharedConfigsRepository")
 */
class VioletConfigs extends GoogleConfigs
{
    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $storageQuota;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $isDefault;

    // getters setters

    /**
     * @return mixed
     */
    public function getStorageQuota()
    {
        return $this->storageQuota;
    }

    /**
     * @param mixed $storageQuota
     */
    public function setStorageQuota($storageQuota): void
    {
        $this->storageQuota = $storageQuota;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault(bool $isDefault): void
    {
        $this->isDefault = $isDefault;
    }
}
