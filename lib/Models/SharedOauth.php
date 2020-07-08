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
 * @OGM\Node(label="SharedOauth", repository="Hedera\Repositories\SharedOauthRepository")
 */
class SharedOauth implements \JsonSerializable
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
     * @OGM\Property(type="string", key="token_type")
     */
    protected $tokenType;

    /**
     * @var int
     *
     * @OGM\Property(type="int", key="expires_in")
     */
    protected $expiresIn;

    /**
     * @var string
     *
     * @OGM\Property(type="string", key="access_token")
     */
    protected $accessToken;

    /**
     * @var string
     *
     * @OGM\Property(type="string", key="refresh_token")
     */
    protected $refreshToken;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $code;

    /**
     * @var SharedAmocrm|null
     *
     * @OGM\Relationship(type="AMOCRM_OAUTH_IN", direction="OUTGOING", collection=false, mappedBy="sharedOauth", targetEntity="SharedAmocrm")
     */
    protected $sharedAmocrm;

    /**
     * @var SharedIntegrations|null
     *
     * @OGM\Relationship(type="INTEGR_OAUTH_IN", direction="OUTGOING", collection=false, mappedBy="sharedOauth", targetEntity="SharedIntegrations")
     */
    protected $sharedIntegrations;

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
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @param string $tokenType
     */
    public function setTokenType(string $tokenType): void
    {
        $this->tokenType = $tokenType;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     */
    public function setExpiresIn(int $expiresIn): void
    {
        $this->expiresIn = $expiresIn;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken(string $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
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
     * @return SharedIntegrations|null
     */
    public function getSharedIntegrations(): ?SharedIntegrations
    {
        return $this->sharedIntegrations;
    }

    /**
     * @param SharedIntegrations|null $sharedIntegrations
     */
    public function setSharedIntegrations(?SharedIntegrations $sharedIntegrations): void
    {
        $this->sharedIntegrations = $sharedIntegrations;
    }

    public function jsonSerialize()
    {
        return self::serialize();
    }
}
