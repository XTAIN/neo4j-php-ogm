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
 * @OGM\Node(label="DirectoryGroupScopes", repository="Hedera\Repositories\DirectoryGroupScopesRepository")
 */
class DirectoryGroupScopes implements \JsonSerializable
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
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $description;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SHARED_SCOPES_TO_DIRECTORY_GROUP_SCOPES", direction="INCOMING", collection=true, mappedBy="directoryGroupScopes", targetEntity="SharedScopes")
     */
    protected $sharedScopes;

    public function __construct()
    {
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
