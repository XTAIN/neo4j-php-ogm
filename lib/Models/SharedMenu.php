<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="SharedMenu", repository="Hedera\Repositories\SharedMenuRepository")
 */
class SharedMenu implements \JsonSerializable
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
     * @var int|null
     *
     * @OGM\Property(type="int", key="parent_uuid")
     */
    protected $parentUuid;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $icon;

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
    protected $title;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $link;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $visible;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $disabled;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $sort;

    /**
     * @var array
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="array")
     */
    protected $roles;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SUB_MENU", direction="INCOMING", collection=true, mappedBy="sharedMenu", targetEntity="Hedera\Models\SharedMenu")
     */
    protected $sharedMenu;

    public function __construct()
    {
        $this->sharedMenu = new HederaCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getParentUuid(): ?int
    {
        return $this->parentUuid;
    }

    /**
     * @param int|null $parentUuid
     */
    public function setParentUuid(?int $parentUuid): void
    {
        $this->parentUuid = $parentUuid;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     */
    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     */
    public function setLink(?string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @param bool $visible
     */
    public function setVisible(bool $visible): void
    {
        $this->visible = $visible;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     */
    public function setDisabled(bool $disabled): void
    {
        $this->disabled = $disabled;
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
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return Collection
     */
    public function getSharedMenu(): Collection
    {
        return $this->sharedMenu;
    }

    /**
     * @param Collection $sharedMenu
     */
    public function setSharedMenu(Collection $sharedMenu): void
    {
        $this->sharedMenu = $sharedMenu;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
