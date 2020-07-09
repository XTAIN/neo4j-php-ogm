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

trait CreatedAt
{
    /**
     * @var string|null
     *
     * @OGM\Property(type="string", key="created_at", nullable=true)
     * @OGM\Convert(type="created_at")
     */
    protected $createdAt;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     */
    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
