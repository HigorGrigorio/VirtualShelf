<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class LoginController extends Controller
{
    use HasGuardMethods;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @param Request $request
     *
     * @return RedirectResponse|JsonResponse|Response|Redirector
     */
    public function login(Request $request): RedirectResponse|JsonResponse|Response|Redirector
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

    public function logout(Request $request): RedirectResponse|JsonResponse|Response|Redirector
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('login');
    }

    public function showLoginForm(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.login');
    }
}
