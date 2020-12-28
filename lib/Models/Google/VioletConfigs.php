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
     * @var Collection
     *
     * @OGM\Relationship(type="VIOLET_FILES_TO_VIOLET_CONFIGS", direction="INCOMING", collection=true, mappedBy="violetConfigs", targetEntity="Hedera\Models\Google\VioletFiles")
     */
    protected $violetFiles;


    public function __construct()
    {
        parent::__construct();
        $this->violetFiles = new HederaCollection();
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
}
