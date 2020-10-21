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
 * @OGM\Node(label="SharedWidgets", repository="Hedera\Repositories\SharedWidgetsRepository")
 */
class SharedWidgets implements \JsonSerializable
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
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $enabled;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean")
     */
    protected $broken;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $uri;

    /**
     * @var string
     *
     * @deprecated
     * @OGM\Property(type="string")
     */
    protected $path;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", key="front_uri")
     */
    protected $frontUri;

    /**
     * @var mixed
     *
     * @deprecated
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $widgetsJSON;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $manifestJSON;

    /**
     * @var string|null
     *
     * @deprecated
     * @OGM\Property(type="string", key="logo_main")
     */
    protected $logoMain;

    /**
     * @var bool|null
     *
     * @OGM\Property(type="boolean", key="is_private")
     */
    protected $isPrivate;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="WIDGET_INTEGR_IN", direction="INCOMING", collection=true, mappedBy="sharedWidgets", targetEntity="SharedIntegrations")
     */
    protected $sharedIntegrations;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="CUSTOMER_SERVICE_WIDGET_IN", direction="INCOMING", collection=true, mappedBy="sharedWidgets", targetEntity="SharedCustomersServices")
     */
    protected $sharedCustomersServices;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="SHARED_CUSTOMERS_WIDGETS_TO_SHARED_WIDGETS", direction="INCOMING", collection=true, mappedBy="sharedWidgets", targetEntity="SharedCustomersWidgets")
     */
    protected $sharedCustomersWidgets;

    public function __construct()
    {
        $this->sharedIntegrations = new HederaCollection();
        $this->sharedCustomersServices = new HederaCollection();
        $this->sharedCustomersWidgets = new HederaCollection();
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
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return bool|null
     */
    public function getBroken(): ?bool
    {
        return $this->broken;
    }

    /**
     * @param bool|null $broken
     */
    public function setBroken(?bool $broken): void
    {
        $this->broken = $broken;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @deprecated
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string|null
     */
    public function getFrontUri(): ?string
    {
        return $this->frontUri;
    }

    /**
     * @param string|null $frontUri
     */
    public function setFrontUri(?string $frontUri): void
    {
        $this->frontUri = $frontUri;
    }

    /**
     * @deprecated
     * @return mixed
     */
    public function getWidgetsJSON()
    {
        return $this->widgetsJSON;
    }

    /**
     * @deprecated
     * @param mixed $widgetsJSON
     */
    public function setWidgetsJSON($widgetsJSON): void
    {
        $this->widgetsJSON = $widgetsJSON;
    }

    /**
     * @return mixed
     */
    public function getManifestJSON()
    {
        return $this->manifestJSON;
    }

    /**
     * @param mixed $manifestJSON
     */
    public function setManifestJSON($manifestJSON): void
    {
        $this->manifestJSON = $manifestJSON;
    }

    /**
     * @deprecated
     * @return string|null
     */
    public function getLogoMain(): ?string
    {
        return $this->logoMain;
    }

    /**
     * @deprecated
     * @param string|null $logoMain
     */
    public function setLogoMain(?string $logoMain): void
    {
        $this->logoMain = $logoMain;
    }

    /**
     * @return bool|null
     */
    public function getIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    /**
     * @param bool|null $isPrivate
     */
    public function setIsPrivate(?bool $isPrivate): void
    {
        $this->isPrivate = $isPrivate;
    }

    /**
     * @return Collection
     */
    public function getSharedIntegrations(): Collection
    {
        return $this->sharedIntegrations;
    }

    /**
     * @param Collection $sharedIntegrations
     */
    public function setSharedIntegrations(Collection $sharedIntegrations): void
    {
        $this->sharedIntegrations = $sharedIntegrations;
    }

    /**
     * @return Collection
     */
    public function getSharedCustomersServices(): Collection
    {
        return $this->sharedCustomersServices;
    }

    /**
     * @param Collection $sharedCustomersServices
     */
    public function setSharedCustomersServices(Collection $sharedCustomersServices): void
    {
        $this->sharedCustomersServices = $sharedCustomersServices;
    }

    /**
     * @return Collection
     */
    public function getSharedCustomersWidgets(): Collection
    {
        return $this->sharedCustomersWidgets;
    }

    /**
     * @param Collection $sharedCustomersWidgets
     */
    public function setSharedCustomersWidgets(Collection $sharedCustomersWidgets): void
    {
        $this->sharedCustomersWidgets = $sharedCustomersWidgets;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
