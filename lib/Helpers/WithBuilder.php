<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.10.01
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Helpers;

use GraphAware\Neo4j\Client\Formatter\Type\Relationship;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Exceptions\HederaException;
use Hedera\Query\AbstractRelationMapper;
use Hedera\Query\Builder;

trait WithBuilder
{
    /**
     * @var Builder|null $builder
     * */
    protected $builder;

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function builder(\Closure $closure)
    {
        $this->builder = new Builder($this->entityManager, $this);

        $closure($this->builder);

        return $this;
    }

    /**
     * @param string ...$classes
     * @return HederaCollection
     * @throws HederaException
     */
    public function get(...$classes)
    {
        if (empty($this->builder)) {
            throw new HederaException('Before use get method you should initialize builder method');
        }

        $cql = $this->builder->result(...$classes);

        $query = $this->entityManager->createQuery($cql);

        foreach ($this->builder->getGraph() as $key => $item) {
            $query->addEntityMapping(self::getGraphName($key), $item);
        }

        $data = $query->execute();

        $relations = $this->builder->getGraphRelations();

        $collect = new HederaCollection($data);

        if (empty($relations)) {
            return $collect;
        }

        return $collect
            ->map(
                function ($item) use ($relations) {
                    foreach ($item as $key => $value) {
                        // optimize relationship
                        if ($value instanceof Relationship && array_key_exists($key, $relations)) {
                            $item[$key] = new AbstractRelationMapper($value);
                        }
                    }

                    return $item;
                }
            );
    }

    /**
     * @param string|null $class
     * @return int
     */
    public function count(string $class = null): int
    {
        $query = $this->entityManager->createQuery($this->builder->count($class));

        return $query->getOneResult()[self::getGraphName($class)] ?? 0;
    }

    /**
     * @param string|null $class
     * @return string
     */
    protected function getGraphName(string $class = null): string
    {
        return last(explode('\\', $class ?? $this->getClassName()));
    }
}
