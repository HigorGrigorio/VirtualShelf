<?php

namespace App\Http\Controllers\Auth\Login;

use App\Core\Infra\IController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowLoginFormController extends Controller implements IController
{

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        return view('auth.login');
    }
}
