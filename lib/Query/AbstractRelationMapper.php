<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.10.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Query;

use GraphAware\Neo4j\Client\Formatter\Type\Relationship;

class AbstractRelationMapper implements \JsonSerializable
{
    /**
     * @var Relationship $relationship
     */
    protected $relationship;

    /**
     * @param Relationship $relationship
     */
    public function __construct(Relationship $relationship)
    {
        $this->relationship = $relationship;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->relationship->get($name);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->relationship->values();
    }
}
