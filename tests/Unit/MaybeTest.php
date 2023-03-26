<?php

namespace Tests\Unit;

use App\Core\Logic\Maybe;
use PHPUnit\Framework\TestCase;

class MaybeTest extends TestCase
{
    public function test_it_should_be_able_creates_a_maybe_with_a_value()
    {
        $result = Maybe::just(1);
        $this->assertEquals(1, $result->get());
        // test isJust
        $this->assertEquals(true, $result->isJust());
        // test isNothing
        $this->assertEquals(false, $result->isNothing());
    }

    public function test_it_should_be_able_creates_a_maybe_with_null()
    {
        $result = Maybe::just(null);
        $this->assertEquals(null, $result->get());
        // test isJust
        $this->assertEquals(true, $result->isJust());
        // test isNothing
        $this->assertEquals(false, $result->isNothing());
    }

    public function test_it_should_be_able_creates_a_maybe_with_nothing()
    {
        $result = Maybe::nothing();
        $this->assertEquals(null, $result->get());
        // test isJust
        $this->assertEquals(false, $result->isJust());
        // test isNothing
        $this->assertEquals(true, $result->isNothing());
    }

    public function test_it_should_be_able_gets_a_default_value_when_the_maybe_is_nothing()
    {
        $result = Maybe::nothing();
        $result = $result->getOrElse(1);
        $this->assertEquals(1, $result);
    }

    public function test_it_should_be_able_gets_a_default_value_when_the_maybe_is_just()
    {
        $result = Maybe::just(1);
        $result = $result->getOrElse(2);
        $this->assertEquals(1, $result);
    }

    public function test_it_should_be_able_gets_a_default_value_when_the_maybe_is_just_and_the_default_value_is_null()
    {
        $result = Maybe::just(1);
        $result = $result->getOrElse(null);
        $this->assertEquals(1, $result);
    }

    public function test_it_should_be_able_gets_a_default_value_when_the_maybe_is_nothing_and_the_default_value_is_null()
    {
        $result = Maybe::nothing();
        $result = $result->getOrElse(null);
        $this->assertEquals(null, $result);
    }

    public function test_it_should_be_able_gets_a_default_value_when_the_maybe_is_nothing_and_the_default_value_is_a_closure()
    {
        $result = Maybe::nothing();
        $result = $result->getOrElse(function() {
            return 1;
        });
        $this->assertEquals(1, $result);
    }


    public function test_it_should_be_able_check_if_the_maybe_is_null()
    {
        $result = Maybe::just(null);
        $this->expectException(\TypeError::class);

        $result->nonnull();
    }
}
