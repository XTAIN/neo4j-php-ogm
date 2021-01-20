<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.12.21
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Google;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;

/**
 * @OGM\Node(label="SharedConfigs", repository="Hedera\Repositories\SharedConfigsRepository")
 */
class VioletConfigs extends GoogleConfigs
{
    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $storageQuota;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $folders;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $categories;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $users;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $settings;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int")
     */
    protected $counter;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="VIOLET_FILES_TO_VIOLET_CONFIGS", direction="INCOMING", collection=true, mappedBy="violetConfigs", targetEntity="Hedera\Models\Google\VioletFiles")
     */
    protected $violetFiles;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="VIOLET_TEMPLATES_TO_VIOLET_CONFIGS", direction="INCOMING", collection=true, mappedBy="violetConfigs", targetEntity="Hedera\Models\Google\VioletTemplates")
     */
    protected $violetTemplates;


    public function __construct()
    {
        parent::__construct();
        $this->violetFiles = new HederaCollection();
        $this->violetTemplates = new HederaCollection();
    }

    // getters setters

    /**
     * @return mixed
     */
    public function getStorageQuota()
    {
        return $this->storageQuota;
    }

    /**
     * @param mixed $storageQuota
     */
    public function setStorageQuota($storageQuota): void
    {
        $this->storageQuota = $storageQuota;
    }

    /**
     * @return mixed
     */
    public function getFolders()
    {
        return $this->folders;
    }

    /**
     * @param mixed $folders
     */
    public function setFolders($folders): void
    {
        $this->folders = $folders;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
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
     * @return int|null
     */
    public function getCounter(): ?int
    {
        return $this->counter;
    }

    /**
     * @param int|null $counter
     */
    public function setCounter(?int $counter): void
    {
        $this->counter = $counter;
    }

    /**
     * @return Collection
     */
    public function getVioletFiles(): Collection
    {
        return $this->violetFiles;
    }

    /**
     * @param Collection $violetFiles
     */
    public function setVioletFiles(Collection $violetFiles): void
    {
        $this->violetFiles = $violetFiles;
    }

    /**
     * @return Collection
     */
    public function getVioletTemplates(): Collection
    {
        return $this->violetTemplates;
    }

    /**
     * @param Collection $violetTemplates
     */
    public function setVioletTemplates(Collection $violetTemplates): void
    {
        $this->violetTemplates = $violetTemplates;
    }
}
