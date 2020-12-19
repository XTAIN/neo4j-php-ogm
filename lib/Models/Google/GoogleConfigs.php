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
     * @var GoogleAuth|null
     *
     * @OGM\Relationship(type="GOOGLE_CONFIGS_TO_GOOGLE_AUTH", direction="OUTGOING", collection=false, mappedBy="googleConfigs", targetEntity="Hedera\Models\Google\GoogleAuth")
     */
    protected $googleAuth;

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
