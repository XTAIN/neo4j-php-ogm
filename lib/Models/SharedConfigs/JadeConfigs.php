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
class JadeConfigs extends SharedConfigs
{
    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $typeRule;

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
    protected $fromEntity;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $toEntity;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $mainContact;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $filter;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $rules;

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
     * @return string
     */
    public function getTypeRule(): string
    {
        return $this->typeRule;
    }

    /**
     * @param string $typeRule
     */
    public function setTypeRule(string $typeRule): void
    {
        $this->typeRule = $typeRule;
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
    public function getFromEntity(): string
    {
        return $this->fromEntity;
    }

    /**
     * @param string $fromEntity
     */
    public function setFromEntity(string $fromEntity): void
    {
        $this->fromEntity = $fromEntity;
    }

    /**
     * @return string
     */
    public function getToEntity(): string
    {
        return $this->toEntity;
    }

    /**
     * @param string $toEntity
     */
    public function setToEntity(string $toEntity): void
    {
        $this->toEntity = $toEntity;
    }

    /**
     * @return bool
     */
    public function isMainContact(): bool
    {
        return $this->mainContact;
    }

    /**
     * @param bool $mainContact
     */
    public function setMainContact(bool $mainContact): void
    {
        $this->mainContact = $mainContact;
    }

    /**
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param mixed $filter
     */
    public function setFilter($filter): void
    {
        $this->filter = $filter;
    }

    /**
     * @return array|null
     */
    public function getRules(): ?array
    {
        return $this->rules;
    }

    /**
     * @param array|null $rules
     */
    public function setRules(?array $rules): void
    {
        $this->rules = $rules;
    }
}
