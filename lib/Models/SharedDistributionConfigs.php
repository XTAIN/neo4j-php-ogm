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

/**
 * @OGM\Node(label="SharedDistributionConfigs", repository="Hedera\Repositories\SharedDistributionConfigsRepository")
 */
class SharedDistributionConfigs
{
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
    protected $type;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $source;

    /**
     * @var array
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $excludes;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int")
     */
    protected $default;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $data;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="DISTRIB_IN", direction="OUTGOING", collection=false, targetEntity="SharedCustomersServices")
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    /**
     * @return array
     */
    public function getExcludes(): array
    {
        return $this->excludes;
    }

    /**
     * @param array $excludes
     */
    public function setExcludes(array $excludes): void
    {
        $this->excludes = $excludes;
    }

    /**
     * @return int|null
     */
    public function getDefault(): ?int
    {
        return $this->default;
    }

    /**
     * @param int|null $default
     */
    public function setDefault(?int $default): void
    {
        $this->default = $default;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
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
}
