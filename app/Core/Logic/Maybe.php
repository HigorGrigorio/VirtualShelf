<?php

namespace App\Core\Logic;

use TypeError;

class Maybe
{
    private function __construct(private readonly bool  $isJust_,
                                 private readonly mixed $value_ = null)
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

    private static function getFlatOptions(array $options): array
    {
        $default = [
            'nullable' => false,
            'array' => false,
        ];

        if ($options != null && count($options) > 0)
            $default = array_merge($default, $options);

        return $default;
    }

    /**
     * @param mixed $value
     * @param array|null $options
     *
     * Use options to specify if the value can be null or empty array
     *
     * Default options:
     * - nullable: false
     * - array: false
     *
     * @return Maybe
     */
    public static function flat(mixed $value, array $options = null): Maybe
    {
        $options = self::getFlatOptions($options ?? []);

        if ($value instanceof Maybe) {
            if ($value->isJust() && $value->get() == null) {
                $value = null;
            } else {
                return $value;
            }
        }

        if (!$options['nullable'] && is_null($value))
            $result = self::nothing();
        else if (!$options['array'] && is_array($value) && count($value) == 0)
            $result = self::nothing();
        else
            $result = new Maybe(true, $value);

        return $result;
    }

    /**
     * @param mixed $value
     * @param string $message
     * @return Maybe
     *
     */
    public static function check(mixed $value, string $message = ''): Maybe
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
