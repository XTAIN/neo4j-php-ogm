<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.16
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Black;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;
use Hedera\Models\SharedCustomers;
use Hedera\Models\SharedModules;

/**
 * @OGM\Node(label="BlackScheme", repository="Hedera\Repositories\Black\BlackSchemeRepository")
 */
class BlackScheme implements \JsonSerializable
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
    protected $name;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $system;

    /**
     * @var SharedCustomers|null
     *
     * @OGM\Relationship(type="CU_BLACK_SCHEME_IN", direction="OUTGOING", collection=false, targetEntity="Hedera\Models\SharedCustomers")
     */
    protected $sharedCustomers;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="BLACK_CONFIG_IN", direction="INCOMING", collection=true, mappedBy="blackScheme", targetEntity="Hedera\Models\SharedConfigs\BlackConfigs")
     */
    protected $blackConfigs;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="BLACK_RELATION_IN", direction="INCOMING", collection=true, mappedBy="blackScheme", targetEntity="BlackRelationFields")
     */
    protected $blackRelationFields;

    public function __construct()
    {
        $this->blackConfigs  = new HederaCollection();
        $this->blackRelationFields  = new HederaCollection();
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
     * @return bool
     */
    public function isSystem(): bool
    {
        return $this->system;
    }

    /**
     * @param bool $system
     */
    public function setSystem(bool $system): void
    {
        $this->system = $system;
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
     * @return Collection
     */
    public function getBlackConfigs(): Collection
    {
        return $this->blackConfigs;
    }

    /**
     * @param Collection $blackConfigs
     */
    public function setBlackConfigs(Collection $blackConfigs): void
    {
        $this->blackConfigs = $blackConfigs;
    }

    /**
     * @return Collection
     */
    public function getBlackRelationFields(): Collection
    {
        return $this->blackRelationFields;
    }

    /**
     * @param Collection $blackRelationFields
     */
    public function setBlackRelationFields(Collection $blackRelationFields): void
    {
        $this->blackRelationFields = $blackRelationFields;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
