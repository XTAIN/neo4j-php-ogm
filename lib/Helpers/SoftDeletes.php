<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.10.09
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Helpers;

trait SoftDeletes
{
    /**
     * @var string|null
     *
     * @OGM\Property(type="string", key="deleted_at", nullable=true)
     */
    protected $deletedAt;

    /**
     * @return string|null
     */
    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    /**
     * @param string|null $deletedAt
     */
    public function setDeletedAt(?string $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
