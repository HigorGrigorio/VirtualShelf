<?php

namespace Tests\Unit;

use App\Core\Logic\Thenable;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class ThenableTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testIsThenable()
    {
        // any class that not implements Thenable interface or not have a .then() method.
        $this->assertEquals(false, Thenable::isThenable(new class() {}));

        // class that implements the .then() method with public visibility.
        $this->assertEquals(true, Thenable::isThenable(
            new class() {
                public function then(callable $onFulfilled = null, callable $onRejected = null): void
                {
                }
            }
        ));

        // class that implements the .then() method without callbacks
        $this->assertEquals(true, Thenable::isThenable(
            new class() {
                public function then(): void
                {
                }
            }
        ));

        // class that implements the .then() method without public visibility.
        $this->assertEquals(false, Thenable::isThenable(
            new class() {
                private function then(): void
                {
                }
            }
        ));

        // class that extends the abstract class Thenable.
        $this->assertEquals(true, Thenable::isThenable(new class() extends Thenable {
            public function then(callable $onFulfilled = null, callable $onRejected = null): int
            {
                return 0;
            }
        }));
    }
}
