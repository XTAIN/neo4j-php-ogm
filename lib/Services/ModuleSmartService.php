<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.15
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

use GraphAware\Neo4j\OGM\EntityManager;
use Hedera\Models\SharedCustomers;
use Hedera\Models\SharedModules;
use Hedera\Services\Helpers\Cached;

class ModuleSmartService implements BeSmartService
{
    use Cached;

    /**
     * @var string $identifier
     * */
    private $identifier;

    /**
     * @var EntityManager $entityManager
     * */
    private $entityManager;

    /**
     * @var SharedCustomers|null $sharedCustomers
     * */
    protected $sharedCustomers;

    /**
     * @var SharedModules|null $sharedModules
     * */
    protected $sharedModules;

    /**
     * @var string $directory
     * */
    protected static $directory;

    /**
     * @param EntityManager $connection
     */
    public function __construct(EntityManager $connection)
    {
        static::$directory = function_exists('storage_path') ? storage_path('hedera') : static::DIRECTORY;
        $this->entityManager = $connection;
    }

    /**
     * @inheritDoc
     * */
    public function init(string $identifier, bool $force = false): void
    {
        $this->identifier = $identifier;

        self::clearEntities();

        if (!$force && $this->fromCache()) {
            return;
        }

        if (
            $this->loadSharedModules() &&
            $this->loadSharedCustomers()
        ) {
            $this->toCache();
        }
    }

    /**
     * @inheritDoc
     * */
    public function clear(): void
    {
        self::clearEntities();

        self::clearData();
    }

    /**
     * @inheritDoc
     * */
    public function isReady(): bool
    {
        return isset(
            $this->sharedModules,
            $this->sharedCustomers
        );
    }

    /**
     * @return SharedModules|null
     */
    public function getSharedModules(): ?SharedModules
    {
        return $this->sharedModules;
    }

    /**
     * @return SharedCustomers|null
     */
    public function getSharedCustomers(): ?SharedCustomers
    {
        return $this->sharedCustomers;
    }

    /**
     * @return bool
     */
    protected function loadSharedModules(): bool
    {
        $repository = $this->entityManager->getRepository(SharedModules::class);
        /**
         * @var SharedModules|null $apiKey
         * */
        $this->sharedModules = $repository->findOneBy(['key' => $this->identifier]);

        return isset($this->sharedModules);
    }

    /**
     * @return bool
     */
    protected function loadSharedCustomers(): bool
    {
        $this->sharedCustomers = $this->sharedModules->getSharedCustomers();

        return isset($this->sharedCustomers);
    }

    /**
     * @return void
     * */
    protected function clearEntities()
    {
        $this->sharedModules = null;
        $this->sharedCustomers = null;
    }

    /**
     * @return void
     * */
    protected function toCache()
    {
        $data = [
            'control' => time(),
            'sharedModules' => $this->sharedModules,
            'sharedCustomers' => $this->sharedCustomers,
        ];

        self::writeData($data);
    }

    /**
     * @return bool
     * */
    protected function fromCache()
    {
        $data = self::readData();
        if (empty($data)) {
            return false;
        }

        if (empty($data['control']) || $data['control'] + static::EXPIRES < time()) {
            return false;
        }

        $this->sharedModules = SharedModules::factory($data['sharedModules']);
        $this->sharedCustomers = SharedCustomers::factory($data['sharedCustomers']);

        return true;
    }
}
