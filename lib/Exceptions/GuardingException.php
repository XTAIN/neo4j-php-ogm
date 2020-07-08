<?php
/**
 *
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 */

namespace Hedera\Exceptions;

class GuardingException extends HederaException
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setMessage($message);
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = 'HEDERA::GUARD: ' . $message;
    }
}
