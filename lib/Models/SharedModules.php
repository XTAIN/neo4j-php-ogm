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
 * @OGM\Node(label="SharedModules", repository="Hedera\Repositories\SharedModulesRepository")
 */
class SharedModules implements \JsonSerializable
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
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $power;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $key;

    /**
     * @var SharedCustomers|null
     *
     * @OGM\Relationship(type="MODULE_CU_IN", direction="OUTGOING", collection=false, mappedBy="sharedModules", targetEntity="SharedCustomers")
     */
    protected $sharedCustomers;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="MODULE_CONFIG_IN", direction="INCOMING", collection=true, mappedBy="sharedModules", targetEntity="SharedConfigs")
     */
    protected $sharedConfigs;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="INTERMEDIA_IN", direction="INCOMING", collection=true, mappedBy="sharedModules", targetEntity="SharedIntermediaries")
     */
    protected $sharedIntermediaries;

    public function __construct()
    {
        $this->sharedConfigs = new HederaCollection();
        $this->sharedIntermediaries = new HederaCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isPower(): bool
    {
        return $this->power;
    }

    /**
     * @param bool $power
     */
    public function setPower(bool $power): void
    {
        $this->power = $power;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
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
     * @return Collection
     */
    public function getSharedIntermediaries(): Collection
    {
        return $this->sharedIntermediaries;
    }

    /**
     * @param Collection $sharedIntermediaries
     */
    public function setSharedIntermediaries(Collection $sharedIntermediaries): void
    {
        $this->sharedIntermediaries = $sharedIntermediaries;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
