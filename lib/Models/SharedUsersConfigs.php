<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.09.28
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="SharedUsersConfigs", repository="Hedera\Repositories\SharedUsersConfigsRepository")
 */
class SharedUsersConfigs implements \JsonSerializable
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
    protected $type;

    /**
     * @var mixed|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $data;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $active;

    /**
     * @var SharedUsers|null
     *
     * @OGM\Relationship(type="SHARED_USERS_CONFIGS_TO_SHARED_USERS", direction="OUTGOING", collection=false, mappedBy="sharedUsersConfigs", targetEntity="SharedUsers")
     */
    protected $sharedUsers;

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
     * @return mixed|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed|null $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return SharedUsers|null
     */
    public function getSharedUsers(): ?SharedUsers
    {
        return $this->sharedUsers;
    }

    /**
     * @param SharedUsers|null $sharedUsers
     */
    public function setSharedUsers(?SharedUsers $sharedUsers): void
    {
        $this->sharedUsers = $sharedUsers;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
