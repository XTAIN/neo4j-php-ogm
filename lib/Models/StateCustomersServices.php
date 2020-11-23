<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.11.23
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;
use Hedera\Helpers\SoftDeletes;
use Hedera\Helpers\WithTimestamps;

/**
 * @OGM\Node(label="StateCustomersServices", repository="Hedera\Repositories\StateCustomersServicesRepository")
 */
class StateCustomersServices implements \JsonSerializable
{
    use EntityFactory;
    use SerializationHelper;
    use WithTimestamps;
    use SoftDeletes;

    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $code;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $type;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int", nullable=true)
     */
    protected $amoAccountId;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $amoAccountDomain;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int", nullable=true)
     */
    protected $count;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="array")
     */
    protected $periods;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="STATE_CUSTOMERS_SERVICES_TO_SHARED_CUSTOMERS_SERVICES", direction="OUTGOING", collection=false, mappedBy="stateCustomersServices", targetEntity="Hedera\Models\SharedCustomersServices")
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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int|null
     */
    public function getAmoAccountId(): ?int
    {
        return $this->amoAccountId;
    }

    /**
     * @param int|null $amoAccountId
     */
    public function setAmoAccountId(?int $amoAccountId): void
    {
        $this->amoAccountId = $amoAccountId;
    }

    /**
     * @return string|null
     */
    public function getAmoAccountDomain(): ?string
    {
        return $this->amoAccountDomain;
    }

    /**
     * @param string|null $amoAccountDomain
     */
    public function setAmoAccountDomain(?string $amoAccountDomain): void
    {
        $this->amoAccountDomain = $amoAccountDomain;
    }

    /**
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @param int|null $count
     */
    public function setCount(?int $count): void
    {
        $this->count = $count;
    }

    /**
     * @return array|null
     */
    public function getPeriods(): ?array
    {
        return $this->periods;
    }

    /**
     * @param array|null $periods
     */
    public function setPeriods(?array $periods): void
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
     * @param SharedCustomersServices|null $sharedCustomersServices
     */
    public function setSharedCustomersServices(?SharedCustomersServices $sharedCustomersServices): void
    {
        $this->sharedCustomersServices = $sharedCustomersServices;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
