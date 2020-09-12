<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="SharedCustomersWidgets", repository="Hedera\Repositories\SharedCustomersWidgetsRepository")
 */
class SharedCustomersWidgets implements \JsonSerializable
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
     * @var string|null
     *
     * @OGM\Property(type="string", key="updated_at_amo")
     */
    protected $updatedAtAmo;

    /**
     * @var int
     *
     * @OGM\Property(type="int", key="id_widget")
     */
    protected $idWidget; // need convert from id to id_widget

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $code;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", key="secret_key")
     */
    protected $secretKey;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $version;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int")
     */
    protected $installs;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $type;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $active;

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
    protected $description;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $categories;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $state;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $logo;

    /**
     * @var mixed|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $settings;

    /**
     * @var SharedAmocrm|null
     *
     * @OGM\Relationship(type="AMOCRM_CU_WIDGET_IN", direction="OUTGOING", collection=false, mappedBy="sharedCustomersWidgets", targetEntity="SharedAmocrm")
     */
    protected $sharedAmocrm;

    /**
     * @var SharedWidgets|null
     *
     * @OGM\Relationship(type="CU_WIDGET_IN", direction="OUTGOING", collection=false, mappedBy="sharedCustomersWidgets", targetEntity="SharedWidgets")
     */
    protected $sharedWidgets;

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
     * @return string|null
     */
    public function getUpdatedAtAmo(): ?string
    {
        return $this->updatedAtAmo;
    }

    /**
     * @param string|null $updatedAtAmo
     */
    public function setUpdatedAtAmo(?string $updatedAtAmo): void
    {
        $this->updatedAtAmo = $updatedAtAmo;
    }

    /**
     * @return int
     */
    public function getIdWidget(): int
    {
        return $this->idWidget;
    }

    /**
     * @param int $idWidget
     */
    public function setIdWidget(int $idWidget): void
    {
        $this->idWidget = $idWidget;
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
    public function getSecretKey(): ?string
    {
        return $this->secretKey;
    }

    /**
     * @param string|null $secretKey
     */
    public function setSecretKey(?string $secretKey): void
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @param string|null $version
     */
    public function setVersion(?string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return int|null
     */
    public function getInstalls(): ?int
    {
        return $this->installs;
    }

    /**
     * @param int|null $installs
     */
    public function setInstalls(?int $installs): void
    {
        $this->installs = $installs;
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCategories(): string
    {
        return $this->categories;
    }

    /**
     * @param string $categories
     */
    public function setCategories(string $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed|null
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed|null $settings
     */
    public function setSettings($settings): void
    {
        $this->settings = $settings;
    }

    /**
     * @return SharedAmocrm|null
     */
    public function getSharedAmocrm(): ?SharedAmocrm
    {
        return $this->sharedAmocrm;
    }

    /**
     * @param SharedAmocrm|null $sharedAmocrm
     */
    public function setSharedAmocrm(?SharedAmocrm $sharedAmocrm): void
    {
        $this->sharedAmocrm = $sharedAmocrm;
    }

    /**
     * @return SharedWidgets|null
     */
    public function getSharedWidgets(): ?SharedWidgets
    {
        return $this->sharedWidgets;
    }

    /**
     * @param SharedWidgets|null $sharedWidgets
     */
    public function setSharedWidgets(?SharedWidgets $sharedWidgets): void
    {
        $this->sharedWidgets = $sharedWidgets;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
