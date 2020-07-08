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
class IvoryConfigs extends SharedConfigs
{
    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $entityId;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $entityType;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $accountId;

    /**
     * @return string
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @param string $entityId
     */
    public function setEntityId(string $entityId): void
    {
        $this->entityId = $entityId;
    }

    /**
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entityType;
    }

    /**
     * @param string $entityType
     */
    public function setEntityType(string $entityType): void
    {
        $this->entityType = $entityType;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId(string $accountId): void
    {
        $this->accountId = $accountId;
    }
}
