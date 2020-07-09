<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Lime;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="LimeCondact", repository="Hedera\Repositories\Lime\LimeCondactRepository")
 */
class LimeCondact
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
    protected $name;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int", nullable=true)
     */
    protected $extends;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $inner;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean")
     */
    protected $extendsCondStatus;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean")
     */
    protected $condStatus;

    /**
     * @var LimeRules|null
     *
     * @OGM\Relationship(type="LIME_RULES_CONDACT_IN", direction="OUTGOING", collection=false, mappedBy="limeCondact", targetEntity="LimeRules")
     */
    protected $limeRules;

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
     * @return int|null
     */
    public function getExtends(): ?int
    {
        return $this->extends;
    }

    /**
     * @param int|null $extends
     */
    public function setExtends(?int $extends): void
    {
        $this->extends = $extends;
    }

    /**
     * @return mixed
     */
    public function getInner()
    {
        return $this->inner;
    }

    /**
     * @param mixed $inner
     */
    public function setInner($inner): void
    {
        $this->inner = $inner;
    }

    /**
     * @return bool|null
     */
    public function getExtendsCondStatus(): ?bool
    {
        return $this->extendsCondStatus;
    }

    /**
     * @param bool|null $extendsCondStatus
     */
    public function setExtendsCondStatus(?bool $extendsCondStatus): void
    {
        $this->extendsCondStatus = $extendsCondStatus;
    }

    /**
     * @return bool|null
     */
    public function getCondStatus(): ?bool
    {
        return $this->condStatus;
    }

    /**
     * @param bool|null $condStatus
     */
    public function setCondStatus(?bool $condStatus): void
    {
        $this->condStatus = $condStatus;
    }

    /**
     * @return LimeRules|null
     */
    public function getLimeRules(): ?LimeRules
    {
        return $this->limeRules;
    }

    /**
     * @param LimeRules|null $limeRules
     */
    public function setLimeRules(?LimeRules $limeRules): void
    {
        $this->limeRules = $limeRules;
    }
}
