<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.12.30
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Google;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="VioletTemplates", repository="Hedera\Repositories\Google\VioletTemplatesRepository")
 */
class VioletTemplates implements \JsonSerializable
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
    protected $category;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $nameTemplate;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $pathTemplate;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $counter;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $priceResult;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $driveMime;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $cfLink;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="array")
     */
    protected $users;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $driveFile;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $taskType;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $taskConfig;

    /**
     * @var VioletConfigs|null
     *
     * @OGM\Relationship(type="VIOLET_TEMPLATES_TO_VIOLET_CONFIGS", direction="OUTGOING", collection=false, mappedBy="violetTemplates", targetEntity="Hedera\Models\Google\VioletConfigs")
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
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     */
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getNameTemplate(): string
    {
        return $this->nameTemplate;
    }

    /**
     * @param string $nameTemplate
     */
    public function setNameTemplate(string $nameTemplate): void
    {
        $this->nameTemplate = $nameTemplate;
    }

    /**
     * @return string
     */
    public function getPathTemplate(): string
    {
        return $this->pathTemplate;
    }

    /**
     * @param string $pathTemplate
     */
    public function setPathTemplate(string $pathTemplate): void
    {
        $this->pathTemplate = $pathTemplate;
    }

    /**
     * @return int
     */
    public function getCounter(): int
    {
        return $this->counter;
    }

    /**
     * @param int $counter
     */
    public function setCounter(int $counter): void
    {
        $this->counter = $counter;
    }

    /**
     * @return bool
     */
    public function isPriceResult(): bool
    {
        return $this->priceResult;
    }

    /**
     * @param bool $priceResult
     */
    public function setPriceResult(bool $priceResult): void
    {
        $this->priceResult = $priceResult;
    }

    /**
     * @return string|null
     */
    public function getDriveMime(): ?string
    {
        return $this->driveMime;
    }

    /**
     * @param string|null $driveMime
     */
    public function setDriveMime(?string $driveMime): void
    {
        $this->driveMime = $driveMime;
    }

    /**
     * @return mixed
     */
    public function getCfLink()
    {
        return $this->cfLink;
    }

    /**
     * @param mixed $cfLink
     */
    public function setCfLink($cfLink): void
    {
        $this->cfLink = $cfLink;
    }

    /**
     * @return array|null
     */
    public function getUsers(): ?array
    {
        return $this->users;
    }

    /**
     * @param array|null $users
     */
    public function setUsers(?array $users): void
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function getDriveFile()
    {
        return $this->driveFile;
    }

    /**
     * @param mixed $driveFile
     */
    public function setDriveFile($driveFile): void
    {
        $this->driveFile = $driveFile;
    }

    /**
     * @return string|null
     */
    public function getTaskType(): ?string
    {
        return $this->taskType;
    }

    /**
     * @param string|null $taskType
     */
    public function setTaskType(?string $taskType): void
    {
        $this->taskType = $taskType;
    }

    /**
     * @return mixed
     */
    public function getTaskConfig()
    {
        return $this->taskConfig;
    }

    /**
     * @param mixed $taskConfig
     */
    public function setTaskConfig($taskConfig): void
    {
        $this->taskConfig = $taskConfig;
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
