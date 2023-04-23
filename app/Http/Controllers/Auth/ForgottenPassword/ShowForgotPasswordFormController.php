<?php

namespace App\Http\Controllers\Auth\ForgottenPassword;

use App\Core\Infra\IController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShowForgotPasswordFormController extends Controller implements IController
{
    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        return View::make('auth.passwords.email');
    }
}
