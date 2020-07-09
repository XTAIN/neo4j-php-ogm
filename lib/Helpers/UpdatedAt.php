<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.09
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Helpers;

use GraphAware\Neo4j\OGM\Annotations as OGM;

trait UpdatedAt
{
    /**
     * @var string|null
     *
     * @OGM\Property(type="string", key="updated_at", nullable=true)
     * @OGM\Convert(type="updated_at")
     */
    protected $updatedAt;

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
