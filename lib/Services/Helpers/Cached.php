<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.15
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services\Helpers;

trait Cached
{
    /**
     * @return array|null
     * */
    protected function readData(): ?array
    {
        self::checkDirectory();

        $file = self::getFilename();
        if (!file_exists(self::getDirectory($file))) {
            return null;
        }

        return json_decode(file_get_contents(self::getDirectory($file)), true);
    }

    /**
     * @param array $data
     * @return void
     */
    protected function writeData(array $data)
    {
        self::checkDirectory();

        $file = self::getFilename();
        file_put_contents(self::getDirectory($file), json_encode($data));
        try {
            chmod(self::getDirectory($file), 0664);
        } catch (\Error $error) {
            // not permitted
        }
    }

    /**
     * @return void
     * */
    protected function clearData()
    {
        self::checkDirectory();

        $file = self::getFilename();
        if (file_exists(self::getDirectory($file))) {
            unlink(self::getDirectory($file));
        }
    }

    /**
     * @return string
     * */
    protected function getFilename(): string
    {
        return md5($this->identifier) . '.json';
    }

    /**
     * @param string|null $file
     * @return string
     */
    protected function getDirectory(string $file = null): string
    {
        return static::$directory . (isset($file) ? ('/' . $file) : '');
    }

    /**
     * @return void
     */
    protected function checkDirectory()
    {
        if (!is_dir(self::getDirectory())) {
            @mkdir(self::getDirectory(), 0775, true);
        }
    }
}
