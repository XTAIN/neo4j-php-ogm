<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

use GraphAware\Neo4j\Client\Neo4jClientEvents;
use GraphAware\Neo4j\OGM\EntityManager;
use GraphAware\Neo4j\OGM\Events;
use GraphAware\Neo4j\OGM\Listeners\HederaFlushListener;
use GraphAware\Neo4j\OGM\Listeners\HederaListener;
use Hedera\Exceptions\GuardingException;

class ConnectorService
{
    /**
     * @var EntityManager[] $connections
     * */
    private $connections = [];

    /**
     * @var EntityManager $defaultConnection
     * */
    private $defaultConnection;

    /**
     * @var array|null $configs
     * */
    private $configs;

    /**
     * @param array|null $connection
     * @throws GuardingException
     */
    public function __construct(array $connection = null)
    {
        $this->configs = function_exists('config') ? config('hedera') : null;
        if (empty($connection)) {
            if (!empty($this->configs)) {
                $connection = $this->configs['connections'][$this->configs['default']] ?? null;
            }
        }

        if (empty($connection)) {
            throw new GuardingException(
                'Before using service, store hedera config file or init config in the constructor'
            );
        }

        $this->addConnection($this->configs['default'] ?? 'default', $connection, true);
    }

    /**
     * @param string $name
     * @param array $connection
     * @param bool $isDefault
     * @return void
     */
    public function addConnection(string $name, array $connection, bool $isDefault = false): void
    {
        if (!empty($connection['url'])) {
            $url = $connection['url'];
        }

        if (empty($url)) {
            $protocol = $connection['protocol'] ?? 'http';
            $username = $connection['username'] ?? null;
            $password = $connection['password'] ?? '';
            $host = $connection['host'] ?? '127.0.0.1';
            $port = $connection['port'] ?? '7474';

            $url = $protocol . '://';

            if (isset($username)) {
                $url .= $username . ':' . $password . '@';
            }

            $url .= $host . ':' . $port;
        }

        $entityManager = EntityManager::create($url, $connection['cache'] ?? null);
        ($connection['listeners'] ?? false) && self::injectHederaEventListeners($entityManager);

        $this->connections[$name] = $entityManager;

        if ($isDefault) {
            $this->defaultConnection = $entityManager;
        }
    }

    /**
     * @param string|null $name
     * @return EntityManager|null
     */
    public function getConnection(string $name = null)
    {
        if (!empty($name)) {
            return $this->connections[$name] ?? null;
        }

        return $this->defaultConnection;
    }

    /**
     * @param EntityManager $entityManager
     */
    protected function injectHederaEventListeners(EntityManager $entityManager)
    {
        $eventDispatcher = $entityManager->getDatabaseDriver()->getEventDispatcher();

        $hederaListener = new HederaListener();

        $eventDispatcher
            ->addListener(Neo4jClientEvents::NEO4J_PRE_RUN, [$hederaListener, 'onPreRun']);
        $eventDispatcher
            ->addListener(Neo4jClientEvents::NEO4J_POST_RUN, [$hederaListener, 'onPostRun']);
        $eventDispatcher
            ->addListener(Neo4jClientEvents::NEO4J_ON_FAILURE, [$hederaListener, 'onFailure']);

        $hederaFlushListener = new HederaFlushListener();

        $entityManager
            ->getEventManager()
            ->addEventListener(Events::PRE_FLUSH, $hederaFlushListener);
        $entityManager
            ->getEventManager()
            ->addEventListener(Events::ON_FLUSH, $hederaFlushListener);
        $entityManager
            ->getEventManager()
            ->addEventListener(Events::POST_FLUSH, $hederaFlushListener);
    }
}
