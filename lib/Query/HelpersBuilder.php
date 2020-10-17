<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.10.17
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Query;

class HelpersBuilder
{
    /**
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
    }

    /**
     * @param string $class
     * @param string $prop
     * @param string $operator
     * @param string|null $value
     * @return string
     */
    public function whereRevertDate(string $class, string $prop, $operator, $value = null)
    {
        $graph = self::getGraphName($class);

        $value = "'$value'";

        $prop = preg_match('/^(\[).*/', $prop) ? $prop : ".$prop";

        return " date(CASE size(head(split($graph$prop, '-'))) WHEN 4 THEN $graph$prop ELSE reduce(accumulator = '', item in reverse(split($graph$prop, '-')) | accumulator + CASE WHEN accumulator = '' THEN '' ELSE '-' END + item) END) $operator date($value)";
    }

    /**
     * @param string $class
     * @return string
     */
    protected function getGraphName(string $class): string
    {
        return last(explode('\\', $class));
    }
}
