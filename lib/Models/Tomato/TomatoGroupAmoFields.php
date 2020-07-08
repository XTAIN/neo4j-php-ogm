<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Tomato;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Models\SharedCustomersServices;

/**
 * @OGM\Node(label="TomatoGroupAmoFields", repository="Hedera\Repositories\Tomato\TomatoGroupAmoFieldsRepository")
 */
class TomatoGroupAmoFields
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $fields;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $groupId;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $groupName;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="TOMATO_SERVICE_IN", direction="OUTGOING", collection=false, targetEntity="Hedera\Models\SharedCustomersServices")
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
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields): void
    {
        $this->fields = $fields;
    }

    /**
     * @return string
     */
    public function getGroupId(): string
    {
        return $this->groupId;
    }

    /**
     * @param string $groupId
     */
    public function setGroupId(string $groupId): void
    {
        $this->groupId = $groupId;
    }

    /**
     * @return string
     */
    public function getGroupName(): string
    {
        return $this->groupName;
    }

    /**
     * @param string $groupName
     */
    public function setGroupName(string $groupName): void
    {
        $this->groupName = $groupName;
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
