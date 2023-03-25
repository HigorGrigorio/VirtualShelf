<?php

namespace Tests\Unit;

use Exception;
use PHPUnit\Framework\TestCase;

use App\Core\Logic\Result;

class ResultTest extends TestCase
{
    public function testResult()
    {
        $result = new Result(function($resolve, $reject) {
            $resolve(1);
        });

        $this->assertEquals(1, $result->get());
    }

    public function testThenAfterResolve()
    {
        $result = new Result(function($resolve, $reject) {
            $resolve(1);
        });

        $result->then(function($value) {
            $this->assertEquals(1, $value);
        });
    }
}
