<?php

namespace App\Core\Logic;

use Throwable;

class Result extends Thenable
{
    private ResultStatus $status_;

    private mixed $value_;

    private array $callbacks_ = [];
    private array $fulfillmentActions_ = [];

    private array $rejectActions_ = [];

    private array $catchActions_ = [];

    private array $finallyActions_ = [];

    public function __construct(mixed $executor)
    {
        $this->status_ = ResultStatus::Pending;

        if (isset($executor)) {
            try {
                if (self::isThenable($executor) || is_callable($executor)) {
                    Callback::invoke(self::isThenable($executor) ? [$executor, 'then']
                        : $executor, [[$this, 'resolve'], [$this, 'reject']], [$this, 'reject']);
                } else {
                    // reject with a TypeError if executor is not a function
                    self::reject(new \TypeError('Executor must be callable or Thenable'));
                }
            } catch (Throwable $e) {
                // if an exception is thrown, the result is rejected.
                // Not is necessary notify the catch actions or finally actions,
                // because the exception is thrown in the constructor,
                // so the catch actions and finally actions are not registered yet.
                self::reject($e);
            }
        }
    }

    public static function isResult(mixed $value): bool
    {
        return $value instanceof Result;
    }

    public function status(): ResultStatus
    {
        return $this->status_;
    }

    public function get(): mixed
    {
        return self::status() === ResultStatus::Pending ? null : $this->value_;
    }

    private function notify(array $callbacks, mixed $value, Maybe $cache): Maybe
    {
        $cache = Maybe::flat($cache, true);

        foreach ($callbacks as $callback) {
            if (is_callable($callback)) {
                $result = $callback($cache->getOrElse($value));
                $cache = Maybe::flat(Result::isResult($result) ? $result->get() : $result, true);
            }
        }

        return $cache;
    }

    private function catch_($e)
    {
        $this->value_ = $e;
        $this->status_ = ResultStatus::Rejected;
        $this->notify($this->finallyActions_, $e,
            $this->notify($this->catchActions_, $e, Maybe::nothing()));
    }


    private function resolve_($value)
    {
        $this->value_ = $value;
        $this->status_ = ResultStatus::Resolved;
        $cache = Maybe::nothing();

        // notify all fulfillement actions.
        $cache = $this->notify($this->fulfillmentActions_, $value, $cache);

        // notify all finally actions.
        $this->notify($this->finallyActions_, $value, $cache);
    }

    public function resolve(mixed $value = null): Result
    {
        try {
            if (isset($value)) {
                switch (self::status()) {
                    case ResultStatus::Pending:
                        // support for thenables and callables chaining.
                        if (self::isResult($value)) {
                            self::resolve($value->get());
                        } else {
                            self::resolve_($value);
                        }
                        break;
                    case ResultStatus::Resolved:
                    case ResultStatus::Rejected:
                        break;
                }
            }
        } catch (Throwable $e) {
            self::catch_($e);
        }
        return $this;
    }

    private function reject_($value)
    {
        $this->value_ = $value;
        $this->status_ = ResultStatus::Rejected;
        $cache = Maybe::nothing();

        // notify all reject actions.
        $cache = $this->notify($this->rejectActions_, $value, $cache);

        // notify all finally actions.
        $this->notify($this->finallyActions_, $value, $cache);
    }

    public function reject(mixed $value = null): Result
    {
        try {
            if (isset($value)) {
                switch (self::status()) {
                    case ResultStatus::Pending:
                        if (self::isResult($value)) {
                            self::reject($value->get());
                        } else {
                            $this->reject_($value);
                        }
                        break;
                    case ResultStatus::Resolved:
                    case ResultStatus::Rejected:
                        break;
                }
            }
        } catch (Throwable $e) {
            self::catch_($e);
        }
        return $this;
    }

    public function then(callable $onFulfilled = null, callable $onRejected = null): Result
    {
        $result = $this;

        try {
            switch (self::status()) {
                case ResultStatus::Pending:
                    if ($onFulfilled) {
                        $this->fulfillmentActions_[] = $onFulfilled;
                    }
                    if ($onRejected) {
                        $this->rejectActions_[] = $onRejected;
                    }
                    break;
                case ResultStatus::Resolved:
                    if ($onFulfilled) {
                        $callResult = $onFulfilled($this->value_);

                        // support for thenables and callables chaining.
                        if (isset($callResult)) {
                            $result = $this->chaining_($callResult);
                        }
                    }
                    break;
                case ResultStatus::Rejected:
                    if ($onRejected) {
                        $callResult = $onRejected($this->value_);

                        // support for thenables and callables chaining.
                        if (isset($callResult)) {
                            $result = $this->chaining_($callResult);
                        }
                    }
                    break;
            }
        } catch (Throwable $e) {
            $this->catch_($e);
        }
        return $result;
    }

    public function catch(callable $onRejected): Result
    {
        $result = $this;

        try {
            switch (self::status()) {
                case ResultStatus::Pending:
                    $this->catchActions_[] = $onRejected;
                    break;
                case ResultStatus::Resolved:
                    break;
                case ResultStatus::Rejected:
                    $callResult = $onRejected($this->value_);

                    // support for thenables and callables chaining.
                    if (isset($callResult)) {
                        $result = $this->chaining_($callResult);
                    }
                    break;
            }
        } catch (Throwable $e) {
            $this->catch_($e);
        }
        return $result;
    }

    public function finally(callable $onFinally): Result
    {
        $result = $this;

        try {
            switch (self::status()) {
                case ResultStatus::Pending:
                    $this->finallyActions_[] = $onFinally;
                    break;
                case ResultStatus::Resolved:
                case ResultStatus::Rejected:
                    $callResult = $onFinally($this->value_);

                    // support for thenables and callables chaining.
                    if (isset($callResult)) {
                        $result = $this->chaining_($callResult);
                    }
                    break;
            }
        } catch (Throwable $e) {
            $this->catch_($e);
        }
        return $result;
    }

    /**
     * Support for thenables and callables chaining.
     *
     * @param $callResult
     * @return Result
     */
    private function chaining_($callResult): Result
    {
        return self::isResult($callResult) ? $callResult : new Result(function ($resolve, $reject) use ($callResult) {
            $resolve($callResult);
        });
    }
}
