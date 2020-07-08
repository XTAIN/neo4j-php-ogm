<?php
/**
 * Created by Jarvis
 * @author Andrew <3oosor@gmail.com>
 * */

namespace GraphAware\Neo4j\OGM\Converters;

class NestedConverter extends Converter
{
    public function getName()
    {
        return 'nested';
    }

    public function toDatabaseValue($value, ?array $options)
    {
        return isset($value) ? json_encode($value) : null;
    }

    public function toPHPValue(array $values, ?array $options)
    {
        if (!isset($values[$this->propertyName])) {
            return null;
        }

        $assoc = $options['assoc'] ?? false;

        if (is_array($values[$this->propertyName]) && $assoc) {
            return $values[$this->propertyName];
        }

        if (is_object($values[$this->propertyName]) && !$assoc) {
            return $values[$this->propertyName];
        }

        return json_decode($values[$this->propertyName], $assoc);
    }

}
