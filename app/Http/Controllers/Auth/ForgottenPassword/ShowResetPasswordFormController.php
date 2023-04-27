<?php

namespace App\Http\Controllers\Auth\ForgottenPassword;

use Illuminate\Http\Request;

class ShowResetPasswordFormController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{


    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        // TODO: validate.
        return view('auth.passwords.reset')->with(
            ['token' => $request->token, 'email' => $request->email]
        );
    }
}
