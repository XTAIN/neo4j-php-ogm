<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.09.29
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use GraphAware\Neo4j\OGM\EntityManager;
use Hedera\Models\SharedRoles;
use Hedera\Models\SharedUsers;

class KeycloakSmartService implements BeSmartService
{
    /**
     * @var string $identifier
     * */
    private $identifier;

    /**
     * @var EntityManager $entityManager
     * */
    private $entityManager;

    /**
     * @var SharedUsers|null $sharedUsers
     * */
    protected $sharedUsers;

    /**
     * @var SharedRoles|null $sharedRoles
     * */
    protected $sharedRoles = null;

    /**
     * @var Collection $sharedRoleScopes
     * */
    protected $sharedRoleScopes;

    /**
     * @var Collection $sharedUserScopes
     * */
    protected $sharedUserScopes;

    /**
     * @param EntityManager $connection
     */
    public function __construct(EntityManager $connection)
    {
        $this->entityManager = $connection;

        $this->sharedRoleScopes = new HederaCollection();
        $this->sharedUserScopes = new HederaCollection();
    }

    /**
     * @inheritDoc
     * */
    public function init(string $identifier, bool $force = false): void
    {
        $this->identifier = $identifier;

        if ($this->loadSharedUsers()) {
            //
        }
    }

    /**
     * @inheritDoc
     * */
    public function clear(): void
    {
    }

    /**
     * @inheritDoc
     * */
    public function isReady(): bool
    {
        return isset($this->sharedUsers);
    }

    /**
     * @return SharedUsers|null
     */
    public function getSharedUsers(): ?SharedUsers
    {
        return $this->sharedUsers;
    }

    /**
     * @return SharedRoles|null
     */
    public function loadRole(): ?SharedRoles
    {
        if (!self::isReady()) {
            return null;
        }

        if (empty($this->sharedRoles)) {
            $this->sharedRoles = $this->sharedUsers->getSharedRoles();
        }

        return $this->sharedRoles;
    }

    /**
     * @return Collection
     */
    public function loadSharedRoleScopes(): Collection
    {
        if (!self::isReady()) {
            return $this->sharedRoleScopes;
        }

        if (!empty($this->sharedRoles) && $this->sharedRoleScopes->isEmpty()) {
            $this->sharedRoleScopes = $this->sharedRoles->getSharedScopes();
        }

        return $this->sharedRoleScopes;
    }

    /**
     * @return Collection
     */
    public function loadSharedUserScopes(): Collection
    {
        if (!self::isReady()) {
            return $this->sharedUserScopes;
        }

        if ($this->sharedUserScopes->isEmpty()) {
            $this->sharedUserScopes = $this->sharedUsers->getSharedScopes();
        }

        return $this->sharedUserScopes;
    }

    /**
     * @return bool
     */
    protected function loadSharedUsers(): bool
    {
        /**
         * @var \Hedera\Repositories\SharedUsersRepository $repository
         * */
        $repository = $this->entityManager->getRepository(SharedUsers::class);
        $this->sharedUsers = $repository->findUserForKeycloak($this->identifier);

        return isset($this->sharedUsers);
    }
}
