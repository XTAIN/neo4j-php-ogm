<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.12.25
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Google;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="VioletFiles", repository="Hedera\Repositories\Google\VioletFilesRepository")
 */
class VioletFiles implements \JsonSerializable
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
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $link;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $isDrive;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $driveMetadata;

    /**
     * @var VioletConfigs|null
     *
     * @OGM\Relationship(type="VIOLET_FILES_TO_VIOLET_CONFIGS", direction="OUTGOING", collection=false, mappedBy="violetFiles", targetEntity="Hedera\Models\Google\VioletConfigs")
     */
    protected $violetConfigs;


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
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return bool
     */
    public function isDrive(): bool
    {
        return $this->isDrive;
    }

    /**
     * @param bool $isDrive
     */
    public function setIsDrive(bool $isDrive): void
    {
        $this->isDrive = $isDrive;
    }

    /**
     * @return mixed
     */
    public function getDriveMetadata()
    {
        return $this->driveMetadata;
    }

    /**
     * @param mixed $driveMetadata
     */
    public function setDriveMetadata($driveMetadata): void
    {
        $this->driveMetadata = $driveMetadata;
    }

    /**
     * @return VioletConfigs|null
     */
    public function getVioletConfigs(): ?VioletConfigs
    {
        return $this->violetConfigs;
    }

    /**
     * @param VioletConfigs|null $violetConfigs
     */
    public function setVioletConfigs(?VioletConfigs $violetConfigs): void
    {
        $this->violetConfigs = $violetConfigs;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
