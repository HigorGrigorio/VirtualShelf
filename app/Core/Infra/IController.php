<?php

namespace App\Core\Infra;

use Illuminate\Http\Request;

/**
 * Interface Controller
 *
 * template for controllers
 */
interface IController
{
    /**
     * Handle the request and return a response
     *
     * @param Request $request
     */
    public function handle(Request $request);
}
