<?php

namespace App\Core\Logic;

use TypeError;

readonly class Maybe
{
    private function __construct(private bool  $isJust_,
                                 private mixed $value_ = null)
    {
    }

    static function just(mixed $value): Maybe
    {
        return new Maybe(true, $value);
    }

    static function nothing(): Maybe
    {
        return new Maybe(false);
    }

    public static function flat(mixed $value, bool $nullable = false): Maybe
    {
        if ($value instanceof Maybe) {
            if ($value->isJust() && $value->get() == null) {
                $value = null;
            } else {
                return $value;
            }
        }

        if (!$nullable && is_null($value)) {
            return self::nothing();
        }

        return new Maybe(true, $value);
    }

    /**
     * @param mixed $value
     * @return Maybe
     *
     * @throws TypeError
     */
    public static function check(mixed $value, $message = ''): Maybe
    {
        if ($value instanceof Maybe) {
            return $value;
        }

        throw new TypeError($message ?? "Value is not a Maybe");
    }

    public static function unwrap(mixed $value): mixed
    {
        if ($value instanceof Maybe) {
            return $value->get();
        }

        if (is_array($value)) {
            return array_map(fn($v) => self::unwrap($v), $value);
        }

        return $value;
    }

    public function isJust(): bool
    {
        return $this->isJust_;
    }

    public function isNothing(): bool
    {
        return !$this->isJust_;
    }

    public function get(): mixed
    {
        return $this->value_;
    }

    public function getOrElse(mixed $default): mixed
    {
        if ($this->isJust_) {
            return $this->value_;
        }

        if (is_callable($default)) {
            return $default();
        }

        return $default;
    }

    /**
     * @return mixed
     */
    public function nonnull(): Maybe
    {
        if (!is_null($this->value_)) {
            return $this;
        }

        throw new TypeError("Value is null");
    }
}
