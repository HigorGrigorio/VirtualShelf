<?php

namespace App\Http\Controllers\Auth\Login;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasGuardMethods;
use App\Core\Infra\Traits\HasValidator;
use App\Core\Infra\Traits\RedirectsUser;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller implements IController
{
    use HasGuardMethods, RedirectsUser, HasValidator, AlertsUser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function redirectTo(): string
    {
        return 'tables.user.index';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $remember = $request->input('remember', false);

            $raw = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];

            $this->validateWith(
                $this->validator($raw),
            );

            if ($this->guard()->attempt($raw, $remember)) {
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }

                $request->session()->regenerate();

                return redirect()->route($this->redirectPath());
            }

            return back()->withErrors([
                'email' => 'Email or password is incorrect'
            ]);
        } catch (ValidationException $th) {
            $this->alertDanger('Validation error');
            return back()->withInput()->withErrors($th->errors());
        } catch (Exception $th) {
            $this->alertDanger($th->getMessage());
            return back()->withInput();
        }
    }
}
