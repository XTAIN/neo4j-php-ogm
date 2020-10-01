<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.10.01
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Helpers;

use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Exceptions\HederaException;
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

        if (empty($classes)) {
            $classes = $this->builder->getGraph();
        }

        $query = $this->entityManager->createQuery($cql);

        foreach ($classes as $item) {
            $query->addEntityMapping(self::getGraphName($item), $item);
        }

        $data = $query->execute();

        return new HederaCollection($data);
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
