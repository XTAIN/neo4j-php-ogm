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
 * @OGM\Node(label="SharedIntegrations", repository="Hedera\Repositories\SharedIntegrationsRepository")
 */
class SharedIntegrations implements \JsonSerializable
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
    protected $secret;

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
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $state;

    /**
     * @var int
     *
     * @OGM\Property(type="int", key="updated_at")
     */
    protected $updatedAt;

    /**
     * @var int
     *
     * @OGM\Property(type="int", key="version_time")
     */
    protected $versionTime;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $type;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean", key="is_editable")
     */
    protected $isEditable;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean", key="has_widget")
     */
    protected $hasWidget;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean", key="is_enabled")
     */
    protected $isEnabled;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean", key="is_outdated")
     */
    protected $isOutdated;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean", key="has_logo")
     */
    protected $hasLogo;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     */
    protected $langs;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", key="_links")
     */
    protected $links;

    /**
     * @var string
     *
     * @OGM\Property(type="string", key="integration_uuid")
     */
    protected $integrationUuid;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     */
    protected $settings;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     */
    protected $scopes;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $code;

    /**
     * @var string
     *
     * @OGM\Property(type="string", key="secret_key")
     */
    protected $secretKey;

    /**
     * @var SharedAmocrm|null
     *
     * @OGM\Relationship(type="AMOCRM_INTEGR_IN", direction="OUTGOING", collection=false, mappedBy="sharedIntegrations", targetEntity="SharedAmocrm")
     */
    protected $sharedAmocrm;

    /**
     * @var SharedWidgets|null
     *
     * @OGM\Relationship(type="WIDGET_INTEGR_IN", direction="OUTGOING", collection=false, mappedBy="sharedIntegrations", targetEntity="SharedWidgets")
     */
    protected $sharedWidgets;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="INTEGR_OAUTH_IN", direction="INCOMING", collection=true, mappedBy="sharedIntegrations", targetEntity="SharedOauth")
     */
    protected $sharedOauth;

    public function __construct()
    {
        $this->sharedOauth = new HederaCollection();
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
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
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
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param int $state
     */
    public function setState(int $state): void
    {
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): int
    {
        return $this->updatedAt;
    }

    /**
     * @param int $updatedAt
     */
    public function setUpdatedAt(int $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getVersionTime(): int
    {
        return $this->versionTime;
    }

    /**
     * @param int $versionTime
     */
    public function setVersionTime(int $versionTime): void
    {
        $this->versionTime = $versionTime;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isEditable(): bool
    {
        return $this->isEditable;
    }

    /**
     * @param bool $isEditable
     */
    public function setIsEditable(bool $isEditable): void
    {
        $this->isEditable = $isEditable;
    }

    /**
     * @return bool
     */
    public function isHasWidget(): bool
    {
        return $this->hasWidget;
    }

    /**
     * @param bool $hasWidget
     */
    public function setHasWidget(bool $hasWidget): void
    {
        $this->hasWidget = $hasWidget;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return bool
     */
    public function isOutdated(): bool
    {
        return $this->isOutdated;
    }

    /**
     * @param bool $isOutdated
     */
    public function setIsOutdated(bool $isOutdated): void
    {
        $this->isOutdated = $isOutdated;
    }

    /**
     * @return bool
     */
    public function isHasLogo(): bool
    {
        return $this->hasLogo;
    }

    /**
     * @param bool $hasLogo
     */
    public function setHasLogo(bool $hasLogo): void
    {
        $this->hasLogo = $hasLogo;
    }

    /**
     * @return mixed
     */
    public function getLangs()
    {
        return $this->langs;
    }

    /**
     * @param mixed $langs
     */
    public function setLangs($langs): void
    {
        $this->langs = $langs;
    }

    /**
     * @return mixed
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param mixed $links
     */
    public function setLinks($links): void
    {
        $this->links = $links;
    }

    /**
     * @return string
     */
    public function getIntegrationUuid(): string
    {
        return $this->integrationUuid;
    }

    /**
     * @param string $integrationUuid
     */
    public function setIntegrationUuid(string $integrationUuid): void
    {
        $this->integrationUuid = $integrationUuid;
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings): void
    {
        $this->settings = $settings;
    }

    /**
     * @return mixed
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param mixed $scopes
     */
    public function setScopes($scopes): void
    {
        $this->scopes = $scopes;
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
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey(string $secretKey): void
    {
        $this->secretKey = $secretKey;
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

    /**
     * @return Collection
     */
    public function getSharedOauth(): Collection
    {
        return $this->sharedOauth;
    }

    /**
     * @param Collection $sharedOauth
     */
    public function setSharedOauth(Collection $sharedOauth): void
    {
        $this->sharedOauth = $sharedOauth;
    }

    public function jsonSerialize()
    {
        return self::serialize();
    }
}
