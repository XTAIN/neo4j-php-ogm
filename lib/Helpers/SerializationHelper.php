<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Helpers;

trait SerializationHelper
{
    protected $__excludeSerialize = [];

    protected function serializing(): array
    {
        return array_filter(
            get_object_vars($this),
            function ($value, $key) {
                if (is_object($value) && !$value instanceof \stdClass) {
                    return false;
                }

                return !(stripos($key, '__') === 0) && !in_array($key, $this->__excludeSerialize);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    public function __serialize(): array
    {
        return self::serializing();
    }

    public function __unserialize(array $data): void
    {
        self::__construct();
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
