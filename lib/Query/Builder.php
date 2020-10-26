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
     * @var array $relations
     * */
    protected $relations = [];

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
     * @var string $LEFT_CQL_SPLITTER_PATTERN
     * */
    protected static $LEFT_CQL_SPLITTER_PATTERN = '/(OPTIONAL MATCH|WHERE|RETURN)/';

    /**
     * @var string $FIRST_MATCH_CQL_SPLITTER_PATTERN
     * */
    protected static $FIRST_MATCH_CQL_SPLITTER_PATTERN = '/(OPTIONAL MATCH|RETURN)/';

    /**
     * @param EntityManager $entityManager
     * @param ObjectRepository $repository
     */
    public function __construct(EntityManager $entityManager, ObjectRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;

        $graph = self::getGraphName();
        $this->graph[$this->repository->getClassName()] = $this->repository->getClassName();

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
     * @param string $operator
     * @param string|null $value
     * @return Builder
     */
    public function whereDatetime(string $class, string $prop, $operator, $value = null)
    {
        if (func_num_args() == 3) {
            $value = $operator;
            $operator = '=';
        }

        self::_whereDatetime($class, $prop, $operator, $value);

        return $this;
    }

    /**
     * @param string $class
     * @param string $prop
     * @param string $operator
     * @param string|null $value
     * @return Builder
     */
    public function orWhereDatetime(string $class, string $prop, $operator, $value = null)
    {
        if (func_num_args() == 3) {
            $value = $operator;
            $operator = '=';
        }

        self::_whereDatetime($class, $prop, $operator, $value, 'OR');

        return $this;
    }

    /**
     * @param string $class
     * @param string|null $forClass
     * @param string|null $relationType
     * @return Builder
     */
    public function whereWithNot(
        string $class,
        string $forClass = null,
        string $relationType = null
    ) {
        self::_whereWithNot($class, $forClass, $relationType);

        return $this;
    }

    /**
     * @param string $class
     * @param string|null $forClass
     * @param string|null $relationType
     * @return Builder
     */
    public function orWhereWithNot(
        string $class,
        string $forClass = null,
        string $relationType = null
    ) {
        self::_whereWithNot($class, $forClass, $relationType, 'OR');

        return $this;
    }

    /**
     * @param string $data
     * @return Builder
     */
    public function whereMixed(string $data)
    {
        self::_whereMixed($data);

        return $this;
    }

    /**
     * @param string $data
     * @return Builder
     */
    public function orWhereMixed(string $data)
    {
        self::_whereMixed($data, 'OR');

        return $this;
    }

    /**
     * @param string $class
     * @param string $prop
     * @param string $operator
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
            $this->cql .= " ID($graph) $operator " . (is_array($value) ? json_encode($value) : (int)$value);
        } else {
            switch (true) {
                case is_int($value):
                    break;
                case is_bool($value):
                    $value = $value ? 'true' : 'false';
                    break;
                case is_null($value):
                    $value = 'null';
                    break;
                default:
                    $value = "'$value'";
            }

            $prop = preg_match('/^(\[).*/', $prop) ? $prop : ".$prop";
            $this->cql .= " $graph$prop $operator $value";
        }
    }

    /**
     * @param string $class
     * @param string $prop
     * @param string $operator
     * @param null $value
     * @param string $type
     */
    private function _whereDatetime(
        string $class,
        string $prop,
        $operator,
        $value = null,
        string $type = 'AND'
    ) {
        if ($this->whereStart) {
            $this->cql .= ' WHERE';
        } else {
            $this->cql .= " $type";
        }

        $this->whereStart = false;

        $graph = self::getGraphName($class);

        $value = "'$value'";

        $prop = preg_match('/^(\[).*/', $prop) ? $prop : ".$prop";
        $this->cql .= " datetime(reduce(accumulator = '', item in split($graph$prop, ' ') | accumulator + CASE WHEN accumulator = '' THEN '' ELSE 'T' END + item)) $operator datetime($value)";
    }

    /**
     * @param string $class
     * @param string|null $forClass
     * @param string|null $relationType
     * @param string $type
     */
    private function _whereWithNot(
        string $class,
        ?string $forClass,
        ?string $relationType,
        string $type = 'AND'
    ) {
        if ($this->whereStart) {
            $this->cql .= ' WHERE NOT';
        } else {
            $this->cql .= " $type NOT";
        }

        $this->whereStart = false;

        $graphNot = self::getGraphName($class);
        $graph = self::getGraphName($forClass);

        $this->cql .= " ($graph)-[" . ($relationType ? ":$relationType" : '') . "]-(:$graphNot)";
    }

    /**
     * @param string $data
     * @param string $type
     */
    private function _whereMixed(string $data, string $type = 'AND')
    {
        if ($this->whereStart) {
            $this->cql .= ' WHERE';
        } else {
            $this->cql .= " $type";
        }

        $this->whereStart = false;

        $this->cql .= $data;
    }

    /**
     * @param string $class
     * @param string|null $relationType
     * @param string|null $alias
     * @param string|null $aliasRelation
     * @return Builder
     */
    public function with(string $class, string $relationType = null, string $alias = null, string $aliasRelation = null)
    {
        $this->graph[$alias ?? $class] = $class;
        if (!empty($relationType) && !empty($aliasRelation)) {
            $this->relations[$aliasRelation] = $relationType;
        }

        $graph = self::getGraphName($class);

        $this->cql .= '-[' .
            ($aliasRelation && $relationType ? $aliasRelation : '') .
            ($relationType ? ":{$relationType}" : '') .
            ']-(' . ($alias ?? $graph) . ':' . $graph . ')';

        return $this;
    }

    /**
     * @param string|null $fromClass
     * @return Builder
     */
    public function nextMatch(string $fromClass = null)
    {
        self::_match($fromClass, true);

        return $this;
    }

    /**
     * @param string|null $fromClass
     * @param bool $isOptional
     * @return Builder
     */
    public function match(string $fromClass = null, bool $isOptional = false)
    {
        self::_match($fromClass, $isOptional);

        return $this;
    }

    /**
     * @param string|null $fromClass
     * @param bool $isOptional
     * @return void
     */
    private function _match(?string $fromClass, bool $isOptional)
    {
        $graph = self::getGraphName($fromClass);
        $this->cql .= ($isOptional ? ' OPTIONAL ' : ' ') . 'MATCH (' . $graph . ':' . $graph . ')';

        $this->whereStart = true;
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
        $classes = array_reduce(
            $classes,
            function ($result, $item) {
                $result[$item] = $item;
                return $result;
            },
            []
        );

        if (empty($classes)) {
            $classes = self::getGraph();
        }

        $filteredReturn = array_map(
            function ($item) {
                return self::getGraphName($item);
            },
            array_keys(
                array_filter(
                    $classes,
                    function ($item) {
                        return array_key_exists($item, $this->graph);
                    },
                    ARRAY_FILTER_USE_KEY
                )
            )
        );

        return self::_result($filteredReturn);
    }

    /**
     * @param array $graphs
     * @param bool $skipOffset
     * @return string
     */
    private function _result(array $graphs, bool $skipOffset = false)
    {
        $cql = $this->cql;

        $cql .= ' RETURN ' . join(', ', $graphs);
        $cql .= count($this->relations) > 0
            ? ((count($graphs) > 0 ? ', ' : '') . join(', ', array_keys($this->relations))) : '';

        if (!empty($this->orderBy)) {
            $cql .= " ORDER BY $this->orderBy" . (empty($this->orderDirection) ? '' : " $this->orderDirection");
        }

        if (isset($this->offset) && $this->count > 0 && !$skipOffset) {
            self::skipLimited();

            return self::_result($graphs, true);
        }

        return $cql;
    }

    /**
     * @param string|null $class
     * @return string
     */
    public function count(string $class = null)
    {
        $cql = preg_split(self::$FIRST_MATCH_CQL_SPLITTER_PATTERN, $this->cql, 2)[0];
        $graph = self::getGraphName($class);

        return $cql . " RETURN COUNT($graph) as $graph";
    }

    /**
     * @return void
     */
    protected function skipLimited()
    {
        $cql = preg_split(self::$FIRST_MATCH_CQL_SPLITTER_PATTERN, $this->cql, 2)[0];
        preg_match('/OPTIONAL MATCH .*/', $this->cql, $matches);

        $graph = self::getGraphName();

        $cql .= " RETURN ID($graph) as id";

        if (!empty($this->orderBy)) {
            $cql .= " ORDER BY $this->orderBy" . (empty($this->orderDirection) ? '' : " $this->orderDirection");
        }

        $cql .= " SKIP $this->offset LIMIT $this->count";

        $query = $this->entityManager->createQuery($cql);
        $result = $query->execute();

        $ids = array_map(
            function ($item) {
                return $item['id'];
            },
            $result
        );

        // new CQL
        $leftCQL = preg_split(self::$LEFT_CQL_SPLITTER_PATTERN, $cql, 2);
        $ids = json_encode($ids);
        $this->cql = "{$leftCQL[0]} WHERE ID($graph) IN $ids " . ($matches[0] ?? '');
    }

    /**
     * @return array
     */
    public function getGraph()
    {
        return $this->graph;
    }

    /**
     * @return array
     */
    public function getGraphRelations()
    {
        return $this->relations;
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
