<?php


use PHPUnit\Framework\TestCase;
use \App\Core\Logic\Callback;
use \App\Core\Logic\Maybe;

class CallbackTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_it_should_able_to_invoke_a_closure()
    {
        $this->assertEquals(1, Callback::invoke(fn () => 1, [], fn () => 0));
    }

    public function test_it_should_able_to_invoke_a_closure_with_arguments()
    {
        $this->assertEquals(2, Callback::invoke(fn ($a, $b) => $a + $b, [1, 1], fn () => 0));
    }

    public function test_it_should_able_to_invoke_a_closure_with_arguments_and_error_handler()
    {
        $this->assertEquals(0, Callback::invoke(fn ($a, $b) => $a + $b, [1, 'a'], fn () => 0));
    }

    public function test_it_should_able_to_invoke_a_closure_with_arguments_and_error_handler_which_returns_maybe()
    {
        $this->assertEquals(Maybe::nothing(), Callback::invoke(fn ($a, $b) => $a + $b, [1, 'a'], fn () => Maybe::nothing()));
    }
}
