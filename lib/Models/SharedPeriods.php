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
     * @var string
     *
     * @OGM\Property(type="string", key="date_start")
     */
    protected $dateStart;

    /**
     * @var string
     *
     * @OGM\Property(type="string", key="date_end")
     */
    protected $dateEnd;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $period;

    /**
     * @var DirectoryPeriods|null
     *
     * @OGM\Relationship(type="PERIOD_DIR_IN", direction="OUTGOING", collection=false, mappedBy="sharedPeriods", targetEntity="DirectoryPeriods")
     */
    protected $directoryPeriods;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="PERIOD_IN", direction="OUTGOING", collection=false, mappedBy="sharedPeriods", targetEntity="SharedCustomersServices")
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
     * @return string
     */
    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    /**
     * @param string $dateStart
     */
    public function setDateStart(string $dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return string
     */
    public function getDateEnd(): string
    {
        return $this->dateEnd;
    }

    /**
     * @param string $dateEnd
     */
    public function setDateEnd(string $dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return string
     */
    public function getPeriod(): string
    {
        return $this->period;
    }

    /**
     * @param string $period
     */
    public function setPeriod(string $period): void
    {
        $this->period = $period;
    }

    /**
     * @return DirectoryPeriods|null
     */
    public function getDirectoryPeriods(): ?DirectoryPeriods
    {
        return $this->directoryPeriods;
    }

    /**
     * @param DirectoryPeriods|null $directoryPeriods
     */
    public function setDirectoryPeriods(?DirectoryPeriods $directoryPeriods): void
    {
        $this->directoryPeriods = $directoryPeriods;
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
        return self::serializing();
    }
}
