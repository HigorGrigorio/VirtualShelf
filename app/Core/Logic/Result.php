<?php

namespace App\Core\Logic;


class Result
{

    private function __construct(private readonly ResultStatus $status_,
                                 private                       $value_,
                                 private readonly string       $message_ = '')
    {
    }

    public static function check(mixed $value, $message = null): Result
    {
        if ($value instanceof Result) {
            return $value;
        }

        throw new \TypeError($message ?? 'Value must be an instance of Result');
    }

    public static function accept(Maybe $value, string $message = '', bool $nullable = true): Result
    {
        if ($value->isNothing() && !$nullable) {
            throw new \TypeError('Value must not be null');
        }

        // support for exceptions
        if ($value->get() instanceof \Throwable) {
            $value = $value->get()->getMessage();

            if ($message === '') {
                $message = $value;
            }
        }

        return new Result(ResultStatus::ACCEPTED, $value->get(), $message);
    }

    public static function reject(Maybe $value, string $message = ''): Result
    {
        if ($value->isNothing()) {
            $value = null;
        }

        // support for exceptions
        if ($value->get() instanceof \Throwable) {
            $value = $value->get()->getMessage();

            if ($message === '') {
                $message = $value;
            }
        }

        return new Result(ResultStatus::DANGER, $value, $message);
    }

    public static function warning(Maybe $value, string $message = ''): Result
    {
        if ($value->isNothing()) {
            $value = null;
        }

        // support for exceptions
        if ($value instanceof \Throwable) {
            $value = $value->__toString();

            if ($message === '') {
                $message = $value;
            }
        }

        return new Result(ResultStatus::WARNING, $value, $message);
    }

    public static function from(mixed $value, string $message = ''): Result
    {
        if ($value instanceof Result) {
            return $value;
        }

        if ($value instanceof \Throwable) {
            return self::reject(Maybe::just($value), $message);
        }

        if ($value instanceof Maybe) {
            if ($value->isNothing()) {
                return self::reject($value, $message);
            }

            return self::accept($value, $message);
        }

        if ($value === null) {
            return self::reject(Maybe::just($value), $message);
        }

        return self::accept($value, $message);
    }

    static function combine(array $results): Result
    {
        if (count($results) === 0) {
            return Result::accept(Maybe::just([]));
        }

        for ($i = 0; $i < count($results); $i++) {
            $result = $results[$i];

            if ($result->isRejected()) {
                return $result;
            }

            $results[$i] = $result->get();
        }

        return Result::accept(Maybe::just($results));
    }

    public function status(): ResultStatus
    {
        return $this->status_;
    }

    public function get(): mixed
    {
        Result::check($this);
        return $this->value_;
    }

    public function getMessage(): string
    {
        return $this->message_;
    }

    public function isAccepted(): bool
    {
        return $this->status() === ResultStatus::ACCEPTED;
    }

    public function isRejected(): bool
    {
        return $this->status() === ResultStatus::DANGER;
    }

    public function map(callable $callback): Result
    {
        if ($this->isAccepted()) {
            return Result::accept($callback($this->get()));
        }

        return $this;
    }

    public function flatMap(callable $callback): Result
    {
        if ($this->isAccepted()) {
            return Result::check($callback($this->get()), 'Callback must return a Result');
        }

        return $this;
    }

    public function toArray($config): array
    {
        return [
                $config['status'] ?? 'status' => $this->status(),
                $config['value'] ?? 'value' => $this->get(),
                $config['message'] ?? 'message' => $this->getMessage(),
        ];
    }
}
