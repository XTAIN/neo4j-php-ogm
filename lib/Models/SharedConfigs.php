<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="SharedConfigs", repository="Hedera\Repositories\SharedConfigsRepository")
 */
class SharedConfigs implements \JsonSerializable
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
    protected $type;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="CU_SERVICE_CONFIG_IN", direction="OUTGOING", collection=false, mappedBy="sharedConfigs", targetEntity="SharedCustomersServices")
     */
    protected $sharedCustomersServices;

    /**
     * @var SharedModules|null
     *
     * @OGM\Relationship(type="MODULE_CONFIG_IN", direction="OUTGOING", collection=false, mappedBy="sharedConfigs", targetEntity="SharedModules")
     */
    protected $sharedModules;

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
     * @return SharedCustomersServices|null
     */
    public function getSharedCustomersServices(): ?SharedCustomersServices
    {
        return $this->sharedCustomersServices;
    }

    /**
     * @param SharedCustomersServices|null $sharedCustomersServices
     */
    public function setSharedCustomersServices(?SharedCustomersServices $sharedCustomersServices): void
    {
        $this->sharedCustomersServices = $sharedCustomersServices;
    }

    /**
     * @return SharedModules|null
     */
    public function getSharedModules(): ?SharedModules
    {
        return $this->sharedModules;
    }

    /**
     * @param SharedModules|null $sharedModules
     */
    public function setSharedModules(?SharedModules $sharedModules): void
    {
        $this->sharedModules = $sharedModules;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
