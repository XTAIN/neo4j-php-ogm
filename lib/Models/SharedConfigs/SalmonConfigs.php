<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.12.03
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\SharedConfigs;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Models\SharedConfigs;

/**
 * @OGM\Node(label="SharedConfigs", repository="Hedera\Repositories\SharedConfigsRepository")
 */
class SalmonConfigs extends SharedConfigs
{
    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $closeConf;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $dragConf;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $editConf;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $usersConf;

    /**
     * @return array|null
     */
    public function getCloseConf(): ?array
    {
        return $this->closeConf;
    }

    /**
     * @param array|null $closeConf
     */
    public function setCloseConf(?array $closeConf): void
    {
        $this->closeConf = $closeConf;
    }

    /**
     * @return array|null
     */
    public function getDragConf(): ?array
    {
        return $this->dragConf;
    }

    /**
     * @param array|null $dragConf
     */
    public function setDragConf(?array $dragConf): void
    {
        $this->dragConf = $dragConf;
    }

    /**
     * @return array|null
     */
    public function getEditConf(): ?array
    {
        return $this->editConf;
    }

    /**
     * @param array|null $editConf
     */
    public function setEditConf(?array $editConf): void
    {
        $this->editConf = $editConf;
    }

    /**
     * @return array|null
     */
    public function getUsersConf(): ?array
    {
        return $this->usersConf;
    }

    /**
     * @param array|null $usersConf
     */
    public function setUsersConf(?array $usersConf): void
    {
        $this->usersConf = $usersConf;
    }
}
