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

/**
 * @OGM\Node(label="SharedIntermediaries", repository="Hedera\Repositories\SharedIntermediariesRepository")
 */
class SharedIntermediaries
{
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
    protected $title;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $code;

    /**
     * @var bool
     *
     * @OGM\Property(type="boolean", key="is_system")
     */
    protected $isSystem;

    /**
     * @var SharedModules|null
     *
     * @OGM\Relationship(type="INTERMEDIA_IN", direction="OUTGOING", collection=false, mappedBy="sharedIntermediaries" targetEntity="SharedModules")
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
    public function isSystem(): bool
    {
        return $this->isSystem;
    }

    /**
     * @param bool $isSystem
     */
    public function setIsSystem(bool $isSystem): void
    {
        $this->isSystem = $isSystem;
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
}
