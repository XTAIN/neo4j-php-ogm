<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.10.01
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Query;

use Doctrine\Persistence\ObjectRepository;
use GraphAware\Neo4j\OGM\EntityManager;

class Builder
{
    /**
     * @var EntityManager $entityManager
     * */
    private $entityManager;

    /**
     * @var ObjectRepository $repository
     * */
    private $repository;

    /**
     * @var array $graph
     * */
    protected $graph = [];

    /**
     * @var int $offset
     * */
    protected $offset = 0;

    /**
     * @var int $count
     * */
    protected $count = -1;

    /**
     * @var string $orderBy
     * */
    protected $orderBy = null;

    /**
     * @var string $orderDirection
     * */
    protected $orderDirection = null;

    /**
     * @var string $cql
     * */
    protected $cql;

    /**
     * @var bool $whereStart
     * */
    protected $whereStart = true;

    /**
     * @param EntityManager $entityManager
     * @param ObjectRepository $repository
     */
    public function __construct(EntityManager $entityManager, ObjectRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;

        $graph = last(explode('\\', $this->repository->getClassName()));
        $this->graph[] = $this->repository->getClassName();

        $this->cql = 'MATCH (' . $graph . ':' . $graph . ')';
    }

    /**
     * @param string $class
     * @param string $prop
     * @param string $operator
     * @param string|null $value
     * @return Builder
     */
    public function where(string $class, string $prop, $operator, $value = null)
    {
        if (func_num_args() == 3) {
            $value = $operator;
            $operator = '=';
        }

        self::_where($class, $prop, $operator, $value);

        return $this;
    }

    /**
     * @param string $class
     * @param string $prop
     * @param string $operator
     * @param string|null $value
     * @return Builder
     */
    public function orWhere(string $class, string $prop, $operator, $value = null)
    {
        if (func_num_args() == 3) {
            $value = $operator;
            $operator = '=';
        }

        self::_where($class, $prop, $operator, $value, 'OR');

        return $this;
    }

    /**
     * @param string $class
     * @param string $prop
     * @param $operator
     * @param null $value
     * @param string $type
     * @return void
     */
    private function _where(string $class, string $prop, $operator, $value = null, string $type = 'AND')
    {
        if ($this->whereStart) {
            $this->cql .= ' WHERE';
        } else {
            $this->cql .= " $type";
        }

        $this->whereStart = false;

        $graph = self::getGraphName($class);

        if (mb_strtoupper($prop) == 'ID') {
            $this->cql .= " ID($graph) $operator " . ((int)$value);
        } else {
            $prop = preg_match('/^(\[).*/', $prop) ? $prop : ".$prop";
            $this->cql .= " $graph$prop $operator '$value'";
        }
    }

    /**
     * @param string $class
     * @param string|null $relationType
     * @return Builder
     */
    public function with(string $class, string $relationType = null)
    {
        $this->graph[] = $class;

        $graph = self::getGraphName($class);
        $this->cql .= '-[' . ($relationType ? ":{$relationType}" : '') . ']-(' . $graph . ':' . $graph . ')';

        return $this;
    }

    /**
     * @param string|null $fromClass
     * @return Builder
     */
    public function nextMatch(string $fromClass = null)
    {
        $graph = self::getGraphName($fromClass);
        $this->cql .= ' OPTIONAL MATCH (' . $graph . ':' . $graph . ')';

        $this->whereStart = true;

        return $this;
    }

    /**
     * @param int $offset
     * @param int|null $count
     * @return Builder
     */
    public function limit(int $offset, int $count = null)
    {
        if (func_num_args() == 1) {
            $count = $offset;
            $offset = 0;
        }

        $this->offset = $offset;
        $this->count = $count;

        return $this;
    }

    /**
     * @param string $class
     * @param string $prop
     * @param string|null $direction
     * @return Builder
     */
    public function orderBy(string $class, string $prop, string $direction = null)
    {
        $this->orderBy = self::getGraphName($class) . ".$prop";
        $this->orderDirection = $direction == 'DESC' ? 'DESC' : null;

        return $this;
    }

    /**
     * @param string ...$classes
     * @return string
     */
    public function result(...$classes)
    {
        $cql = $this->cql;

        if (empty($classes)) {
            $classes = self::getGraph();
        }

        $classes = array_unique($classes);

        $filteredReturn = array_map(
            function ($item) {
                return self::getGraphName($item);
            },
            array_filter(
                $classes,
                function ($item) {
                    return in_array($item, $this->graph);
                }
            )
        );

        $cql .= ' RETURN ' . join(', ', $filteredReturn);

        if (!empty($this->orderBy)) {
            $cql .= " ORDER BY $this->orderBy" . (empty($this->orderDirection) ? '' : " $this->orderDirection");
        }

        if (isset($this->offset) && $this->count > 0) {
            $cql .= " SKIP $this->offset LIMIT $this->count";
        }

        return $cql;
    }

    /**
     * @param string|null $class
     * @return string
     */
    public function count(string $class = null)
    {
        $cql = preg_replace('/OPTIONAL MATCH .*/', '', $this->cql);
        $graph = self::getGraphName($class);

        return $cql . " RETURN COUNT($graph) as $graph";
    }

    /**
     * @return array
     */
    public function getGraph()
    {
        return array_unique($this->graph);
    }

    /**
     * @param string|null $class
     * @return string
     */
    protected function getGraphName(string $class = null): string
    {
        return last(explode('\\', $class ?? $this->repository->getClassName()));
    }
}
