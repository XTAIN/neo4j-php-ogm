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
 * @OGM\Node(label="SharedScopes", repository="Hedera\Repositories\SharedScopesRepository")
 */
class SharedScopes implements \JsonSerializable
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
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $code;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $description;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SHARED_USERS_TO_SHARED_SCOPES", direction="INCOMING", collection=true, mappedBy="sharedScopes", targetEntity="SharedUsers")
     */
    protected $sharedUsers;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SHARED_ROLES_TO_SHARED_SCOPES", direction="INCOMING", collection=true, mappedBy="sharedScopes", targetEntity="SharedRoles")
     */
    protected $sharedRoles;

    /**
     * @var DirectoryGroupScopes|null
     *
     * @OGM\Relationship(type="SHARED_SCOPES_TO_DIRECTORY_GROUP_SCOPES", direction="OUTGOING", collection=false, mappedBy="sharedScopes", targetEntity="DirectoryGroupScopes")
     */
    protected $directoryGroupScopes;

    public function __construct()
    {
        $this->sharedUsers = new HederaCollection();
        $this->sharedRoles = new HederaCollection();
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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
    public function getSharedRoles(): Collection
    {
        return $this->sharedRoles;
    }

    /**
     * @param Collection $sharedRoles
     */
    public function setSharedRoles(Collection $sharedRoles): void
    {
        $this->sharedRoles = $sharedRoles;
    }

    /**
     * @return DirectoryGroupScopes|null
     */
    public function getDirectoryGroupScopes(): ?DirectoryGroupScopes
    {
        return $this->directoryGroupScopes;
    }

    /**
     * @param DirectoryGroupScopes|null $directoryGroupScopes
     */
    public function setDirectoryGroupScopes(?DirectoryGroupScopes $directoryGroupScopes): void
    {
        $this->directoryGroupScopes = $directoryGroupScopes;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
