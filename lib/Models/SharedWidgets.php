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

/**
 * @OGM\Node(label="SharedWidgets", repository="Hedera\Repositories\SharedWidgetsRepository")
 */
class SharedWidgets
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
     * @OGM\Property(type="string")
     */
    protected $path;

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
     * @OGM\Relationship(type="CU_WIDGET_IN", direction="INCOMING", collection=true, mappedBy="sharedWidgets", targetEntity="SharedCustomersWidgets")
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
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
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
}
