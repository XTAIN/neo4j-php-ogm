<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="SharedPeriods", repository="Hedera\Repositories\SharedPeriodsRepository")
 */
class SharedPeriods implements \JsonSerializable
{
    use EntityFactory;
    use SerializationHelper;

    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var array
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $periods;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="PERIOD_IN", direction="INCOMING", collection=false, mappedBy="sharedPeriods", targetEntity="SharedCustomersServices")
     */
    protected $sharedCustomersServices;

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
     * @return array
     */
    public function getPeriods(): array
    {
        return $this->periods;
    }

    /**
     * @param array $periods
     */
    public function setPeriods(array $periods): void
    {
        $this->periods = $periods;
    }

    /**
     * @return SharedCustomersServices|null
     */
    public function getSharedCustomersServices(): ?SharedCustomersServices
    {
        return $this->sharedCustomersServices;
    }

    /**
     * @param SharedCustomersServices|null $sharedCustomerServices
     */
    public function setSharedCustomersServices(?SharedCustomersServices $sharedCustomerServices): void
    {
        $this->sharedCustomersServices = $sharedCustomerServices;
    }

    public function jsonSerialize()
    {
        return self::serialize();
    }
}
