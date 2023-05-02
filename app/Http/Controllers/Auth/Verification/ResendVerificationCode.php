<?php

namespace App\Http\Controllers\Auth\Verification;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasValidator;
use App\Core\Infra\Traits\RedirectsUser;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;

class ResendVerificationCode extends Controller implements IController
{
    use RedirectsUser, HasValidator, AlertsUser;

    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('handle');
    }

    public function redirectTo(): string
    {
        return route(RouteServiceProvider::HOME);
    }

    public function handle(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail())
                throw new Exception('Your email is already verified.');

            $request->user()->sendEmailVerificationNotification();

            $this->alertInfo('A new verification link has been sent to your email address.');
            $return = back();
        } catch (Exception $th) {
            $this->alertDanger($th->getMessage());
            $return = back()->withInput();
        }

        return $return;
    }
}
