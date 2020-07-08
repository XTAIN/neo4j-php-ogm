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
class OtterConfigs extends SharedConfigs
{
    /**
     * @var string|null see config type -> type_otter (conflict)
     *
     * @OGM\Property(type="string", key="type_otter")
     */
    protected $typeOtter;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean")
     */
    protected $power;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $for;

    /**
     * @var mixed|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $rules;

    /**
     * @var mixed|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $list;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean", key="power_contact")
     */
    protected $powerContact;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean", key="power_company")
     */
    protected $powerCompany;

    /**
     * @return string|null
     */
    public function getTypeOtter(): ?string
    {
        return $this->typeOtter;
    }

    /**
     * @param string|null $typeOtter
     */
    public function setTypeOtter(?string $typeOtter): void
    {
        $this->typeOtter = $typeOtter;
    }

    /**
     * @return bool|null
     */
    public function getPower(): ?bool
    {
        return $this->power;
    }

    /**
     * @param bool|null $power
     */
    public function setPower(?bool $power): void
    {
        $this->power = $power;
    }

    /**
     * @return string|null
     */
    public function getFor(): ?string
    {
        return $this->for;
    }

    /**
     * @param string|null $for
     */
    public function setFor(?string $for): void
    {
        $this->for = $for;
    }

    /**
     * @return mixed|null
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param mixed|null $rules
     */
    public function setRules($rules): void
    {
        $this->rules = $rules;
    }

    /**
     * @return mixed|null
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param mixed|null $list
     */
    public function setList($list): void
    {
        $this->list = $list;
    }

    /**
     * @return bool|null
     */
    public function getPowerContact(): ?bool
    {
        return $this->powerContact;
    }

    /**
     * @param bool|null $powerContact
     */
    public function setPowerContact(?bool $powerContact): void
    {
        $this->powerContact = $powerContact;
    }

    /**
     * @return bool|null
     */
    public function getPowerCompany(): ?bool
    {
        return $this->powerCompany;
    }

    /**
     * @param bool|null $powerCompany
     */
    public function setPowerCompany(?bool $powerCompany): void
    {
        $this->powerCompany = $powerCompany;
    }
}
