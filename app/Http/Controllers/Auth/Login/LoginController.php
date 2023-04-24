<?php

namespace App\Http\Controllers\Auth\Login;

use App\Core\Infra\IController;
use App\Http\Controllers\Auth\HasGuardMethods;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller implements IController
{
    use HasGuardMethods;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        // TODO: use case.
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        if (!$email) {
            return redirect()->intended('login')->withErrors([
                'email' => 'Email is required'
            ]);
        }

        if (!$password) {
            return redirect()->intended('login')->withErrors([
                'password' => 'Password is required'
            ]);
        }

        if ($this->guard()->attempt(['email' => $email, 'password' => $password], $remember)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            $request->session()->regenerate();

            return redirect()->intended('tables/users');
        }

        return redirect()->intended('login')->withErrors([
            'email' => 'Email or password is incorrect'
        ]);
    }
}
