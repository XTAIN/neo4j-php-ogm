<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.12.14
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Google;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Models\SharedConfigs;

/**
 * @OGM\Node(label="SharedConfigs", repository="Hedera\Repositories\SharedConfigsRepository")
 */
class GoogleConfigs extends SharedConfigs
{
    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $googleId;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $email;

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
    protected $picture;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $isDefault;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean")
     */
    protected $revoked;

    /**
     * @var GoogleAuth|null
     *
     * @OGM\Relationship(type="GOOGLE_CONFIGS_TO_GOOGLE_AUTH", direction="OUTGOING", collection=false, mappedBy="googleConfigs", targetEntity="Hedera\Models\Google\GoogleAuth")
     */
    protected $googleAuth;

    // getters setters

    /**
     * @return string
     */
    public function getGoogleId(): string
    {
        return $this->googleId;
    }

    /**
     * @param string $googleId
     */
    public function setGoogleId(string $googleId): void
    {
        $this->googleId = $googleId;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault(bool $isDefault): void
    {
        $this->isDefault = $isDefault;
    }

    /**
     * @return bool
     */
    public function isRevoked(): bool
    {
        return $this->revoked;
    }

    /**
     * @param bool $revoked
     */
    public function setRevoked(bool $revoked): void
    {
        $this->revoked = $revoked;
    }

    /**
     * @return GoogleAuth|null
     */
    public function getGoogleAuth(): ?GoogleAuth
    {
        return $this->googleAuth;
    }

    /**
     * @param GoogleAuth|null $googleAuth
     */
    public function setGoogleAuth(?GoogleAuth $googleAuth): void
    {
        $this->googleAuth = $googleAuth;
    }
}
