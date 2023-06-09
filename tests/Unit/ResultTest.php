<?php


use App\Core\Logic\Result;
use App\Core\Logic\ResultStatus;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    // TODO: In the future, only it should be able create a new results instances with a callback, or through factory methods.
    public function test_it_should_be_able_creates_a_new_result()
    {
        $result = Result::new();
        $this->assertEquals(null, $result->get());
        // test status
        $this->assertEquals(ResultStatus::Pending, $result->status());
    }

    public function test_it_should_be_able_creates_a_new_result_rejecting_a_value()
    {
        $result = Result::decline(1);
        $this->assertEquals(1, $result->get());
        // test status
        $this->assertEquals(ResultStatus::Rejected, $result->status());
    }

    public function test_it_should_be_able_creates_a_new_result_resolving_a_value()
    {
        $result = Result::accept(1);
        $this->assertEquals(1, $result->get());
        // test status
        $this->assertEquals(ResultStatus::Resolved, $result->status());
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_manipulate_the_value_that_is_passed_as_parameter_in_chaining_without_alter_the_original_value_of_promise()
    {
        $result = Result::accept(1);
        $result->then(function ($value) {
            return $value + 1;
        })->then(function ($value) {
            $this->assertEquals(2, $value);
        });
        $this->assertEquals(1, $result->get());
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_construct_a_promise_without_solve_or_reject_in_constructor()
    {
        $result = Result::new();

        $this->assertEquals(null, $result->get());
        $this->assertEquals(ResultStatus::Pending, $result->status());

        $result->then(function ($value) {
            $this->assertEquals(1, $value);
        });

        $result->resolve(1);

        $result = Result::new();

        $result->then(
            function () {
                // not executed
                $this->assertEquals(1, 0);
            },
            function ($value) {
                $this->assertEquals(1, $value);
            });

        $result->reject(1);
    }

    public function test_it_should_be_able_resolves_a_promise()
    {
        $result = Result::accept(Result::decline(1));

        $this->assertEquals(1, $result->get());
    }

    public function test_it_should_be_able_stores_a_closure_with_resolve_method()
    {
        $result = Result::accept(function () {
            return 1535;
        });

        $this->assertEquals(ResultStatus::Resolved, $result->status());

        $callResult = $result->get()();

        $this->assertEquals(1535, $callResult);
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_rejects_a_promise()
    {
        $result = Result::decline(Result::accept(1));

        $result->then(function () use ($result) {
            $this->assertEquals(ResultStatus::Rejected, $result->status());
        });

        $this->assertEquals(1, $result->get());
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_stores_a_closure_with_reject_method()
    {
        $result = Result::decline(function () {
            return 1535;
        });

        $this->assertEquals(ResultStatus::Rejected, $result->status());

        $callResult = $result->get()();

        $this->assertEquals(1535, $callResult);
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_resolves_a_new_promise_in_chaining()
    {
        $result = Result::accept(1);

        $result->then(function ($value) {
            $this->assertEquals(1, $value);

            return Result::decline(2);
        })->then(function ($value) {
            $this->assertEquals(2, $value);

            return Result::accept(3);
        })->then(function ($value) {
            $this->assertEquals(3, $value);
        });

        $this->assertEquals(1, $result->get());
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_handle_a_exception_with_catch_method()
    {
        $result = Result::accept(1);

        $result->then(function ($value) {
            $this->assertEquals(1, $value);

            throw new Exception('test');
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->catch(function ($value) {
            $this->assertEquals('test', $value->getMessage());
        });

        $this->assertEquals('test', $result->get()->getMessage());
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_handle_a_exception_and_continue_chaining()
    {
        $result = Result::accept(1);

        $result->then(function ($value) {
            $this->assertEquals(1, $value);

            throw new Exception('test');
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->catch(function ($value) {
            $this->assertEquals('test', $value->getMessage());
        })->then(
            function () {
                // it should not be called.
                $this->assertEquals(false, true);
            },
            function ($value) {
                $this->assertEquals('test', $value->getMessage());
            }
        );

        $this->assertEquals('test', $result->get()->getMessage());
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_handle_a_exception_and_return_a_value_to_next_chain()
    {
        $result = Result::accept(1);

        $result->then(function ($value) {
            $this->assertEquals(1, $value);

            throw new Exception('test');
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->catch(function ($value) {
            $this->assertEquals('test', $value->getMessage());

            return 2;
        })->then(function ($value) {
            $this->assertEquals(2, $value);
        });

        $this->assertEquals(Exception::class, get_class($result->get()));
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_handle_a_exception_and_return_a_promise_to_next_chain()
    {
        $result = Result::accept(1);

        $result->then(function ($value) {
            $this->assertEquals(1, $value);

            throw new Exception('test');
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->catch(function ($value) {
            $this->assertEquals('test', $value->getMessage());

            return Result::accept(2);
        })->then(function ($value) {
            $this->assertEquals(2, $value);
        });

        $this->assertEquals(Exception::class, get_class($result->get()));
    }

    /**
     * @throws Exception
     */
    public function test_it_should_be_able_finally_method_called_after_all_actions_of_chaining()
    {
        $result = Result::accept(1);

        $result->finally(function ($value) {
            $this->assertEquals(true, true);
        })->then(function ($value) {
            $this->assertEquals(1, $value);

            throw new Exception('test');
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->then(function () {
            // it should not be called.
            $this->assertEquals(false, true);
        })->catch(function ($value) {
            $this->assertEquals('test', $value->getMessage());

            return 2;
        })->then(function ($value) {
            $this->assertEquals(2, $value);
        })->resolve(1);

        $this->assertEquals(Exception::class, get_class($result->get()));
    }
}
