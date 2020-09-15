<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="SharedCustomersServices", repository="Hedera\Repositories\SharedCustomersServicesRepository")
 */
class SharedCustomersServices implements \JsonSerializable
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
     * @var boolean
     *
     * @OGM\Property(type="boolean")
     */
    protected $active;

    /**
     * @var SharedApikeys|null
     *
     * @OGM\Relationship(type="APIKEY_IN", direction="OUTGOING", collection=false, mappedBy="sharedCustomersServices", targetEntity="Hedera\Models\SharedApikeys")
     */
    protected $sharedApikey;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="PERIOD_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomersServices", targetEntity="Hedera\Models\SharedPeriods")
     */
    protected $sharedPeriods;

    /**
     * @var SharedAmocrm|null
     *
     * @OGM\Relationship(type="AMOCRM_IN", direction="OUTGOING", collection=false, mappedBy="sharedCustomersServices", targetEntity="Hedera\Models\SharedAmocrm")
     */
    protected $sharedAmocrm;

    /**
     * @var SharedCustomers|null
     *
     * @OGM\Relationship(type="CUSTOMER_SERVICE_IN", direction="OUTGOING", collection=false, mappedBy="sharedCustomersServices", targetEntity="Hedera\Models\SharedCustomers")
     */
    protected $sharedCustomers;

    /**
     * @var SharedWidgets|null
     *
     * @OGM\Relationship(type="CUSTOMER_SERVICE_WIDGET_IN", direction="OUTGOING", collection=false, mappedBy="sharedCustomersServices", targetEntity="Hedera\Models\SharedWidgets")
     */
    protected $sharedWidgets;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="CU_SERVICE_CONFIG_IN", direction="INCOMING", collection=true, mappedBy="sharedCustomersServices", targetEntity="Hedera\Models\SharedConfigs")
     */
    protected $sharedConfigs;

    /**
     * @var SharedIntegrations|null
     *
     * @OGM\Relationship(type="CU_SERV_INTEGR_IN", direction="OUTGOING", collection=false, mappedBy="sharedCustomersServices", targetEntity="Hedera\Models\SharedIntegrations")
     */
    protected $sharedIntegrations;

    public function __construct()
    {
        $this->sharedConfigs = new HederaCollection();
        $this->sharedPeriods = new HederaCollection();
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
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return SharedApikeys|null
     */
    public function getSharedApikey(): ?SharedApikeys
    {
        return $this->sharedApikey;
    }

    /**
     * @param SharedApikeys|null $sharedApikey
     */
    public function setSharedApikey(?SharedApikeys $sharedApikey): void
    {
        $this->sharedApikey = $sharedApikey;
    }

    /**
     * @return Collection
     */
    public function getSharedPeriods(): Collection
    {
        return $this->sharedPeriods;
    }

    /**
     * @param Collection $sharedPeriods
     */
    public function setSharedPeriods(Collection $sharedPeriods): void
    {
        $this->sharedPeriods = $sharedPeriods;
    }

    /**
     * @return SharedAmocrm|null
     */
    public function getSharedAmocrm(): ?SharedAmocrm
    {
        return $this->sharedAmocrm;
    }

    /**
     * @param SharedAmocrm|null $sharedAmocrm
     */
    public function setSharedAmocrm(?SharedAmocrm $sharedAmocrm): void
    {
        $this->sharedAmocrm = $sharedAmocrm;
    }

    /**
     * @return SharedCustomers|null
     */
    public function getSharedCustomers(): ?SharedCustomers
    {
        return $this->sharedCustomers;
    }

    /**
     * @param SharedCustomers|null $sharedCustomers
     */
    public function setSharedCustomers(?SharedCustomers $sharedCustomers): void
    {
        $this->sharedCustomers = $sharedCustomers;
    }

    /**
     * @return SharedWidgets|null
     */
    public function getSharedWidgets(): ?SharedWidgets
    {
        return $this->sharedWidgets;
    }

    /**
     * @param SharedWidgets|null $sharedWidgets
     */
    public function setSharedWidgets(?SharedWidgets $sharedWidgets): void
    {
        $this->sharedWidgets = $sharedWidgets;
    }

    /**
     * @return Collection
     */
    public function getSharedConfigs(): Collection
    {
        return $this->sharedConfigs;
    }

    /**
     * @param Collection $sharedConfigs
     */
    public function setSharedConfigs(Collection $sharedConfigs): void
    {
        $this->sharedConfigs = $sharedConfigs;
    }

    /**
     * @return SharedIntegrations|null
     */
    public function getSharedIntegrations(): ?SharedIntegrations
    {
        return $this->sharedIntegrations;
    }

    /**
     * @param SharedIntegrations|null $sharedIntegrations
     */
    public function setSharedIntegrations(?SharedIntegrations $sharedIntegrations): void
    {
        $this->sharedIntegrations = $sharedIntegrations;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
