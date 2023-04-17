<?php

namespace App\Core\Infra;

use Illuminate\Http\Request;

/**
 * Interface Controller
 *
 * template for controllers
 * @template TRequest
 * @template TResponse
 */
interface IController
{
    /**
     * Handle the request and return a response
     *
     * @param TRequest $request
     * @return TResponse
     */
    public function handle(Request $request);
}
