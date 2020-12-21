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
     * @var int
     *
     * @OGM\Property(type="int")
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
     * @var GoogleAuth|null
     *
     * @OGM\Relationship(type="GOOGLE_CONFIGS_TO_GOOGLE_AUTH", direction="OUTGOING", collection=false, mappedBy="googleConfigs", targetEntity="Hedera\Models\Google\GoogleAuth")
     */
    protected $googleAuth;

    // getters setters

    /**
     * @return int
     */
    public function getGoogleId(): int
    {
        return $this->googleId;
    }

    /**
     * @param int $googleId
     */
    public function setGoogleId(int $googleId): void
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
