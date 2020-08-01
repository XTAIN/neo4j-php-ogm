<?php
/**
 * Created by Jarvis
 * @author Andrew <3oosor@gmail.com>
 * */

namespace GraphAware\Neo4j\OGM\Converters;

class ArrayConverter extends Converter
{
    public function getName()
    {
        return 'array';
    }

    public function toDatabaseValue($value, ?array $options)
    {
        if (is_array($value)) { // add iterable object
            return array_map(
                function ($item) {
                    switch (true) {
                        case is_null($item):
                        case is_scalar($item):
                            return $item;
                        default:
                            return json_encode($item);
                    }
                },
                $value
            );
        }

        return isset($value) ? json_encode($value) : null;
    }

    public function toPHPValue(array $values, ?array $options)
    {
        if (!isset($values[$this->propertyName])) {
            return null;
        }

        if (is_array($values[$this->propertyName])) {
            return array_map(
                function ($item) {
                    switch (true) {
                        case is_string($item):
                            $length = mb_strlen($item);
                            switch (true) {
                                case strpos($item, '[') === 0 && strrpos($item, ']') === $length - 1:
                                case strpos($item, '{') === 0 && strrpos($item, '}') === $length - 1:
                                    $result = json_decode($item);
                                    break;
                                default:
                                    $result = $item;
                            }

                            return $result ?? $item;
                        default:
                            return $item;
                    }
                },
                $values[$this->propertyName]
            );
        }

        if (is_object($values[$this->propertyName])) {
            return $values[$this->propertyName];
        }

        return json_decode($values[$this->propertyName], true);
    }

}
