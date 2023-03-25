<?php

namespace App\Core\Logic;

use Exception;
use ReflectionException;
use ReflectionParameter;

/**
 * All objects of type Promise implement the Thenable interface.
 * A thenable implements the .then() method, which is called with two
 * callbacks: one for when the promise is fulfilled, one for when it is rejected.
 * Promises are also possible.
 *
 * @see https://promisesaplus.com/
 */
abstract class Thenable
{
    /**
     * @note The .then() method returns a promise. It takes two arguments:
     * callback functions for the success and failure cases of the Promise.
     *
     * @param callable|null $onFulfilled
     * @param callable|null $onRejected
     * @return mixed The value returned by the called callback function.
     *
     * @throws Exception
     */
    public abstract function then(callable $onFulfilled = null, callable $onRejected = null): mixed;

    /**
     * To be a thenable, the value must have a .then() method with
     * public visibility and all parameters must be callable.
     *
     * @param mixed $value
     * @return bool
     *
     * @throws ReflectionException
     */
    static public function isThenable(mixed $value): bool
    {
        if ($value instanceof Thenable) {
            return true;
        }

        if (is_object($value)) {
            $reflection = new \ReflectionObject($value);

            if (!$reflection->hasMethod('then')) {
                return false;
            }

            $then = $reflection->getMethod('then');

            if ($then->isPublic()) {
                foreach ($then->getParameters() as $parameter) {
                    if ($parameter->getType()->getName() !== 'callable') {
                        return false;
                    }
                }
                return true;
            }
        }

        return false;
    }
}
