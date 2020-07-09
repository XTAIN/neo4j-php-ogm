<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Lime;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Models\SharedCustomers;

/**
 * @OGM\Node(label="LimeRules", repository="Hedera\Repositories\Lime\LimeRulesRepository")
 */
class LimeRules
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
    protected $name;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $status;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $sort;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $event;

    /**
     * @var mixed|null
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $eventData;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean")
     */
    protected $isInner;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="LIME_RULES_CONDACT_IN", direction="INCOMING", collection=true, mappedBy="limeRules", targetEntity="LimeCondact")
     */
    protected $limeCondact;

    /**
     * @var SharedCustomers|null
     *
     * @OGM\Relationship(type="LIME_RULES_CU_IN", direction="OUTGOING", collection=false, mappedBy="limeRules", targetEntity="Hedera\Models\SharedCustomers")
     */
    protected $sharedCustomers;

    public function __construct()
    {
        $this->limeCondact = new HederaCollection();
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
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     */
    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @return string|null
     */
    public function getEvent(): ?string
    {
        return $this->event;
    }

    /**
     * @param string|null $event
     */
    public function setEvent(?string $event): void
    {
        $this->event = $event;
    }

    /**
     * @return mixed|null
     */
    public function getEventData()
    {
        return $this->eventData;
    }

    /**
     * @param mixed|null $eventData
     */
    public function setEventData($eventData): void
    {
        $this->eventData = $eventData;
    }

    /**
     * @return bool|null
     */
    public function getIsInner(): ?bool
    {
        return $this->isInner;
    }

    /**
     * @param bool|null $isInner
     */
    public function setIsInner(?bool $isInner): void
    {
        $this->isInner = $isInner;
    }

    /**
     * @return Collection
     */
    public function getLimeCondact(): Collection
    {
        return $this->limeCondact;
    }

    /**
     * @param Collection $limeCondact
     */
    public function setLimeCondact(Collection $limeCondact): void
    {
        $this->limeCondact = $limeCondact;
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
}
