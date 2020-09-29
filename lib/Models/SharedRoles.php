<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.09.28
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="SharedRoles", repository="Hedera\Repositories\SharedRolesRepository")
 */
class SharedRoles implements \JsonSerializable
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
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $priority;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean")
     */
    protected $guest;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $description;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SHARED_USERS_TO_SHARED_ROLES", direction="INCOMING", collection=true, mappedBy="sharedRoles", targetEntity="SharedUsers")
     */
    protected $sharedUsers;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SHARED_ROLES_TO_SHARED_SCOPES", direction="OUTGOING", collection=true, mappedBy="sharedRoles", targetEntity="SharedScopes")
     */
    protected $sharedScopes;

    public function __construct()
    {
        $this->sharedUsers = new HederaCollection();
        $this->sharedScopes = new HederaCollection();
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
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return bool|null
     */
    public function isGuest(): ?bool
    {
        return $this->guest;
    }

    /**
     * @param bool|null $guest
     */
    public function setGuest(?bool $guest): void
    {
        $this->guest = $guest;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection
     */
    public function getSharedUsers(): Collection
    {
        return $this->sharedUsers;
    }

    /**
     * @param Collection $sharedUsers
     */
    public function setSharedUsers(Collection $sharedUsers): void
    {
        $this->sharedUsers = $sharedUsers;
    }

    /**
     * @return Collection
     */
    public function getSharedScopes(): Collection
    {
        return $this->sharedScopes;
    }

    /**
     * @param Collection $sharedScopes
     */
    public function setSharedScopes(Collection $sharedScopes): void
    {
        $this->sharedScopes = $sharedScopes;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
