<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.12.14
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Google;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;
use Hedera\Helpers\WithTimestamps;
use Hedera\Models\SharedAmocrm;

/**
 * @OGM\Node(label="GoogleAuth", repository="Hedera\Repositories\Google\GoogleAuthRepository")
 */
class GoogleAuth implements \JsonSerializable
{
    use EntityFactory;
    use SerializationHelper;
    use WithTimestamps;

    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

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
     * @var int
     *
     * @OGM\Property(type="int", key="expires_in")
     */
    protected $expiresIn;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $scope;

    /**
     * @var string
     *
     * @OGM\Property(type="string", key="token_type")
     */
    protected $tokenType;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", key="id_token", nullable=true)
     */
    protected $idToken;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int")
     */
    protected $created;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="GOOGLE_CONFIGS_TO_GOOGLE_AUTH", direction="INCOMING", collection=true, mappedBy="googleAuth", targetEntity="Hedera\Models\Google\GoogleConfigs")
     */
    protected $googleConfigs;

    /**
     * @var SharedAmocrm|null
     *
     * @OGM\Relationship(type="GOOGLE_AUTH_TO_SHARED_AMOCRM", direction="OUTGOING", collection=false, mappedBy="googleAuth", targetEntity="Hedera\Models\SharedAmocrm")
     */
    protected $sharedAmocrm;

    public function __construct()
    {
        $this->googleConfigs = new HederaCollection();
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
     * @return string|null
     */
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param string|null $scope
     */
    public function setScope(?string $scope): void
    {
        $this->scope = $scope;
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
     * @return string|null
     */
    public function getIdToken(): ?string
    {
        return $this->idToken;
    }

    /**
     * @param string|null $idToken
     */
    public function setIdToken(?string $idToken): void
    {
        $this->idToken = $idToken;
    }

    /**
     * @return int|null
     */
    public function getCreated(): ?int
    {
        return $this->created;
    }

    /**
     * @param int|null $created
     */
    public function setCreated(?int $created): void
    {
        $this->created = $created;
    }

    /**
     * @return Collection
     */
    public function getGoogleConfigs(): Collection
    {
        return $this->googleConfigs;
    }

    /**
     * @param Collection $googleConfigs
     */
    public function setGoogleConfigs(Collection $googleConfigs): void
    {
        $this->googleConfigs = $googleConfigs;
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

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
