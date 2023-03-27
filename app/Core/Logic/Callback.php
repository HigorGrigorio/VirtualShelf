<?php

namespace App\Core\Logic;

use Exception;
use App\Core\Logic\Maybe;

readonly class Callback
{

    /**
     * @param mixed $callback
     * @param array $args
     * @param mixed $onError
     *
     * @return mixed
     *
     * @throws Exception
     */
    public static function invoke(mixed $callback, array $args, mixed $onError): mixed
    {
        $error_handle = Callback::check($onError);

        try {
            return $callback(...$args);
        } catch (\Throwable $e) {
            return $error_handle($e);
        }
    }

    static function check(mixed $callback, bool $syntax = false): callable
    {
        if (!is_callable($callback, $syntax)) {
            throw new \TypeError("Callback is not callable.");
        }

        return $callback;
    }
}
