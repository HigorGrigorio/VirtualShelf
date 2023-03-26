<?php

namespace App\Core\Logic;

use Throwable;

class Result extends Thenable
{
    private ResultStatus $status_;

    private mixed $value_;

    private array $callbacks_ = [];
    private array $fulfillementActions_ = [];

    private array $rejectActions_ = [];

    private array $catchActions_ = [];

    private array $finallyActions_ = [];

    public function __construct(mixed $executor)
    {
        $this->status_ = ResultStatus::Pending;

        if (isset($executor)) {
            try {
                if (self::isThenable($executor)) {
                    $executor->then([$this, 'resolve'], [$this, 'reject']);
                } else if (is_callable($executor)) {
                    $executor([$this, 'resolve'], [$this, 'reject']);
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
                            $this->value_ = $value;
                            $this->status_ = ResultStatus::Resolved;
                            $cache = null;

                            // notify all fulfillement actions.
                            foreach ($this->fulfillementActions_ as $action) {
                                if (is_callable($action)) {
                                    $result = $action($cache ?? $this->value_);

                                    if ($result !== null) {
                                        $cache = self::isResult($value) ? $value->get() : $value;
                                    }
                                }
                            }

                            // notify all finally actions.
                            foreach ($this->finallyActions_ as $action) {
                                if (is_callable($action)) {
                                    $result = $action($value);
                                    $cache = null;

                                    if ($result !== null) {
                                        $cache = self::isResult($value) ? $value->get() : $value;
                                    }
                                }
                            }
                        }
                        break;
                    case ResultStatus::Resolved:
                    case ResultStatus::Rejected:
                        break;
                }
            }
        } catch (Throwable $e) {
            $this->value_ = $e;
            $this->status_ = ResultStatus::Rejected;
            $cache = null;

            // notify all reject actions.
            foreach ($this->catchActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($cache ?? $this->value_);

                    if ($result !== null) {
                        $cache = self::isResult($result) ? $result->get() : $result;
                    }
                }
            }

            // notify all finally actions.
            foreach ($this->finallyActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($value);

                    if ($result !== null) {
                        $cache = self::isResult($value) ? $value->get() : $value;
                    }
                }
            }
        }
        return $this;
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
                            $this->value_ = $value;
                            $this->status_ = ResultStatus::Rejected;
                            $cache = null;
                            // notify all reject actions.
                            foreach ($this->rejectActions_ as $action) {
                                if (is_callable($action)) {
                                    $result = $action($cache ?? $this->value_);

                                    if ($result !== null) {
                                        $cache = self::isResult($result) ? $result->get() : $result;
                                    }
                                }
                            }
                            // notify all finally actions.
                            foreach ($this->finallyActions_ as $action) {
                                if (is_callable($action)) {
                                    $result = $action($value);

                                    if ($result !== null) {
                                        $cache = self::isResult($value) ? $value->get() : $value;
                                    }
                                }
                            }
                        }
                        break;
                    case ResultStatus::Resolved:
                    case ResultStatus::Rejected:
                        break;
                }
            }
        } catch (Throwable $e) {
            $this->value_ = $e;
            $this->status_ = ResultStatus::Rejected;

            $cache = null;
            // notify all reject actions.
            foreach ($this->catchActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($cache ?? $e);

                    if ($result !== null) {
                        $cache = $result;
                    }
                }
            }

            $cache = null;
            // notify all finally actions.
            foreach ($this->finallyActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($cache ?? $e);

                    if ($result !== null) {
                        $cache = $result;
                    }
                }
            }
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
                        $this->fulfillementActions_[] = $onFulfilled;
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
                            $result = self::isResult($callResult) ? $callResult : new Result(function ($resolve, $reject) use ($callResult) {
                                $resolve($callResult);
                            });
                        }
                    }
                    break;
                case ResultStatus::Rejected:
                    if ($onRejected) {
                        $callResult = $onRejected($this->value_);

                        // support for thenables and callables chaining.
                        if (isset($callResult)) {
                            $result = self::isResult($callResult) ? $callResult : new Result(function ($resolve, $reject) use ($callResult) {
                                $resolve($callResult);
                            });
                        }
                    }
                    break;
            }
        } catch (Throwable $e) {
            $this->value_ = $e;
            $this->status_ = ResultStatus::Rejected;
            $cache = null;

            // notify all reject actions.
            foreach ($this->catchActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($cache ?? $this->value_);

                    if ($result !== null) {
                        $cache = $result;
                    }
                }
            }

            // notify all finally actions.
            foreach ($this->finallyActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($e);

                    if ($result !== null) {
                        $cache = $result;
                    }
                }
            }
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
                        $result = self::isResult($callResult) ? $callResult : new Result(function ($resolve, $reject) use ($callResult) {
                            $resolve($callResult);
                        });
                    }
                    break;
            }
        } catch (Throwable $e) {
            $this->value_ = $e;
            $this->status_ = ResultStatus::Rejected;
            $cache = null;

            // notify all reject actions.
            foreach ($this->catchActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($cache ?? $this->value_);

                    if ($result !== null) {
                        $cache = $result;
                    }
                }
            }

            // notify all finally actions.
            foreach ($this->finallyActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($e);

                    if ($result !== null) {
                        $cache = $result;
                    }
                }
            }
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
                        $result = self::isResult($callResult) ? $callResult : new Result(function ($resolve, $reject) use ($callResult) {
                            $resolve($callResult);
                        });
                    }
                    break;
            }
        } catch (Throwable $e) {
            $this->value_ = $e;
            $this->status_ = ResultStatus::Rejected;
            $cache = null;

            // notify all reject actions.
            foreach ($this->catchActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($cache ?? $this->value_);

                    if ($result !== null) {
                        $cache = $result;
                    }
                }
            }

            // notify all finally actions.
            foreach ($this->finallyActions_ as $action) {
                if (is_callable($action)) {
                    $result = $action($e);

                    if ($result !== null) {
                        $cache = $result;
                    }
                }
            }
        }
        return $result;
    }
}
