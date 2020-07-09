<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\EntityManager;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Models\SharedAmocrm;
use Hedera\Models\SharedApikeys;
use Hedera\Models\SharedCustomers;
use Hedera\Models\SharedCustomersServices;
use Hedera\Models\SharedIntegrations;
use Hedera\Models\SharedOauth;
use Hedera\Models\SharedPeriods;

class SmartService
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
     * @var SharedApikeys|null $sharedApiKey
     * */
    protected $sharedApiKey;

    /**
     * @var SharedCustomers|null $sharedCustomers
     * */
    protected $sharedCustomers;

    /**
     * @var SharedCustomersServices|null $sharedCustomersServices
     * */
    protected $sharedCustomersServices;

    /**
     * @var Collection $sharedPeriods
     * */
    protected $sharedPeriods;

    /**
     * @var SharedAmocrm|null $sharedAmocrm
     * */
    protected $sharedAmocrm;

    /**
     * @var SharedOauth|null $sharedOauth
     * */
    protected $sharedOauth;

    /**
     * @var SharedIntegrations|null $sharedIntegrations
     * */
    protected $sharedIntegrations;

    /**
     * @var string $directory
     * */
    protected static $directory = __DIR__ . '/../../storage/hedera';

    /**
     * @var int $expires
     * */
    protected static $expires = 3600;

    /**
     * @param EntityManager $connection
     */
    public function __construct(EntityManager $connection)
    {
        static::$directory = function_exists('storage_path') ? storage_path('hedera') : static::$directory;
        $this->entityManager = $connection;
    }

    /**
     * @param string $identifier
     * @param bool $force
     * @return void
     */
    public function init(string $identifier, bool $force = false)
    {
        $this->identifier = $identifier;

        if (!$force && $this->fromCache()) {
            return;
        }

        if (
            $this->loadSharedApiKey() &&
            $this->loadSharedCustomersService() &&
            $this->loadSharedPeriods() &&
            $this->loadSharedAmocrm() &&
            $this->loadSharedOauth() &&
            $this->loadSharedIntegrations() &&
            $this->loadSharedCustomers()
        ) {
            $this->toCache();
        }
    }

    /**
     * @return void
     */
    public function clear()
    {
        $this->checkDirectory();

        $file = md5($this->identifier) . '.json';
        if (file_exists(self::getDirectory($file))) {
            unlink(self::getDirectory($file));
        }
    }

    /**
     * @return bool
     * */
    public function isReady(): bool
    {
        return isset(
            $this->sharedApiKey,
            $this->sharedCustomers,
            $this->sharedCustomersServices,
            $this->sharedPeriods,
            $this->sharedAmocrm,
            $this->sharedOauth,
            $this->sharedIntegrations
        );
    }

    /**
     * @return SharedApikeys|null
     */
    public function getSharedApiKey(): ?SharedApikeys
    {
        return $this->sharedApiKey;
    }

    /**
     * @return SharedCustomers|null
     */
    public function getSharedCustomers(): ?SharedCustomers
    {
        return $this->sharedCustomers;
    }

    /**
     * @return SharedCustomersServices|null
     */
    public function getSharedCustomersServices(): ?SharedCustomersServices
    {
        return $this->sharedCustomersServices;
    }

    /**
     * @return Collection
     */
    public function getSharedPeriods(): Collection
    {
        return $this->sharedPeriods;
    }

    /**
     * @return SharedAmocrm|null
     */
    public function getSharedAmocrm(): ?SharedAmocrm
    {
        return $this->sharedAmocrm;
    }

    /**
     * @return SharedOauth|null
     */
    public function getSharedOauth(): ?SharedOauth
    {
        return $this->sharedOauth;
    }

    /**
     * @return SharedIntegrations|null
     */
    public function getSharedIntegrations(): ?SharedIntegrations
    {
        return $this->sharedIntegrations;
    }

    /**
     * @return bool
     */
    protected function loadSharedApiKey(): bool
    {
        $repository = $this->entityManager->getRepository(SharedApikeys::class);
        /**
         * @var SharedApikeys|null $apiKey
         * */
        $this->sharedApiKey = $repository->findOneBy(['key' => $this->identifier]);

        return isset($this->sharedApiKey);
    }

    /**
     * @return bool
     */
    protected function loadSharedCustomersService(): bool
    {
        $this->sharedCustomersServices = $this->sharedApiKey->getSharedCustomersServices();

        return isset($this->sharedCustomersServices);
    }

    /**
     * @return bool
     */
    protected function loadSharedPeriods(): bool
    {
        $this->sharedPeriods = $this->sharedCustomersServices->getSharedPeriods();

        return isset($this->sharedPeriods);
    }

    /**
     * @return bool
     */
    protected function loadSharedAmocrm(): bool
    {
        $this->sharedAmocrm = $this->sharedCustomersServices->getSharedAmocrm();

        return isset($this->sharedAmocrm);
    }

    /**
     * @return bool
     */
    protected function loadSharedOauth(): bool
    {
        $this->sharedOauth = $this->sharedAmocrm
            ->getSharedOauth()
            ->filter(
                function (SharedOauth $oauth) {
                    return $oauth->getCode() == $this->sharedCustomersServices->getCode();
                }
            )
            ->first();

        return !empty($this->sharedOauth);
    }

    /**
     * @return bool
     */
    protected function loadSharedIntegrations(): bool
    {
        $this->sharedIntegrations = $this->sharedOauth->getSharedIntegrations();

        return isset($this->sharedIntegrations);
    }

    /**
     * @return bool
     */
    protected function loadSharedCustomers(): bool
    {
        $this->sharedCustomers = $this->sharedCustomersServices->getSharedCustomers();

        return isset($this->sharedCustomers);
    }

    /**
     * @return bool
     */
    protected function fromCache(): bool
    {
        $file = md5($this->identifier) . '.json';
        if (!file_exists(self::getDirectory($file))) {
            return false;
        }

        $data = json_decode(file_get_contents(self::getDirectory($file)), true);

        if (empty($data['control']) || $data['control'] + static::$expires < time()) {
            return false;
        }

        $this->sharedApiKey = SharedApikeys::factory($data['sharedApiKey']);
        $this->sharedCustomersServices = SharedCustomersServices::factory($data['sharedCustomersServices']);
        $this->sharedCustomers = SharedCustomers::factory($data['sharedCustomers']);
        $this->sharedPeriods = new HederaCollection(
            array_map(
                function ($item) {
                    return SharedPeriods::factory($item);
                },
                $data['sharedPeriods'] ?? []
            )
        );
        $this->sharedAmocrm = SharedAmocrm::factory($data['sharedAmocrm']);
        $this->sharedOauth = SharedOauth::factory($data['sharedOauth']);
        $this->sharedIntegrations = SharedIntegrations::factory($data['sharedIntegrations']);

        return true;
    }

    /**
     * @return void
     */
    protected function toCache()
    {
        $this->checkDirectory();

        $file = md5($this->identifier) . '.json';
        $data = [
            'control' => time(),
            'sharedApiKey' => $this->sharedApiKey,
            'sharedCustomersServices' => $this->sharedCustomersServices,
            'sharedCustomers' => $this->sharedCustomers,
            'sharedPeriods' => $this->sharedPeriods,
            'sharedAmocrm' => $this->sharedAmocrm,
            'sharedOauth' => $this->sharedOauth,
            'sharedIntegrations' => $this->sharedIntegrations,
        ];

        file_put_contents(self::getDirectory($file), json_encode($data));
    }

    /**
     * @param string|null $file
     * @return string
     */
    protected function getDirectory(string $file = null): string
    {
        return static::$directory . (isset($file) ? ('/' . $file) : '');
    }

    /**
     * @return void
     */
    protected function checkDirectory()
    {
        if (!is_dir(self::getDirectory())) {
            @mkdir(self::getDirectory(), 0775, true);
        }
    }
}
