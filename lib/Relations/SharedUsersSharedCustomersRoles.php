<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.09.28
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Relations;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\SerializationHelper;
use Hedera\Models\SharedCustomers;
use Hedera\Models\SharedUsers;

/**
 *
 * @OGM\RelationshipEntity(type="SHARED_USERS_TO_SHARED_CUSTOMERS_ROLES")
 */
class SharedUsersSharedCustomersRoles implements \JsonSerializable
{
    use SerializationHelper;

    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var SharedUsers
     *
     * @OGM\StartNode(targetEntity="Hedera\Models\SharedUsers")
     */
    protected $sharedUsers;

    /**
     * @var SharedCustomers
     *
     * @OGM\EndNode(targetEntity="Hedera\Models\SharedCustomers")
     */
    protected $sharedCustomers;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="array")
     */
    protected $roles;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean", nullable=true)
     */
    protected $temporary;

    /**
     * @param SharedUsers $sharedUsers
     * @param SharedCustomers $sharedCustomers
     * @param array|null $roles
     */
    public function __construct(SharedUsers $sharedUsers, SharedCustomers $sharedCustomers, ?array $roles)
    {
        $this->sharedUsers = $sharedUsers;
        $this->sharedCustomers = $sharedCustomers;
        $this->roles = $roles;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return SharedUsers
     */
    public function getSharedUsers(): SharedUsers
    {
        return $this->sharedUsers;
    }

    /**
     * @param SharedUsers $sharedUsers
     */
    public function setSharedUsers(SharedUsers $sharedUsers): void
    {
        $this->sharedUsers = $sharedUsers;
    }

    /**
     * @return SharedCustomers
     */
    public function getSharedCustomers(): SharedCustomers
    {
        return $this->sharedCustomers;
    }

    /**
     * @param SharedCustomers $sharedCustomers
     */
    public function setSharedCustomers(SharedCustomers $sharedCustomers): void
    {
        $this->sharedCustomers = $sharedCustomers;
    }

    /**
     * @return array|null
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @param array|null $roles
     */
    public function setRoles(?array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return bool|null
     */
    public function getTemporary(): ?bool
    {
        return $this->temporary;
    }

    /**
     * @param bool|null $temporary
     */
    public function setTemporary(?bool $temporary): void
    {
        $this->temporary = $temporary;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
