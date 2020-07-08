<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Helpers;

trait EntityFactory
{
    /**
     * @param array $data
     * @param static $instance
     * @return static
     */
    public static function factory(array $data = [], $instance = null)
    {
        $instance = $instance ?? new static();

        foreach ($data as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->{$key} = $value;
            }
        }

        return $instance;
    }
}
