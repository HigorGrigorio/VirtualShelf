<?php

namespace App\Http\Controllers\Auth\ForgottenPassword;

use App\Core\Infra\IController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowForgotPasswordFormController extends Controller implements IController
{
    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
       return view('auth.passwords.email');
    }
}
