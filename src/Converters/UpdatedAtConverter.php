<?php
/**
 * Created by Jarvis
 * @author Andrew <3oosor@gmail.com>
 * */

namespace GraphAware\Neo4j\OGM\Converters;

class UpdatedAtConverter extends Converter
{
    public function getName()
    {
        return 'updated_at';
    }

    public function toDatabaseValue($value, ?array $options)
    {
        return date('Y-m-d H:i:s');
    }

    public function toPHPValue(array $values, ?array $options)
    {
        return $values[$this->propertyName] ?? null;
    }

}
