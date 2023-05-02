<?php

namespace App\Http\Controllers\Auth\ConfirmPassword;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasValidator;
use App\Core\Infra\Traits\RedirectsUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConfirmPasswordController extends Controller implements IController
{
    use HasValidator, AlertsUser, RedirectsUser;

    public function __construct()
    {
        $this->middleware('auth')->only('handle');
    }

    /**
     * @throws ValidationException
     */
    public function handle(Request $request): JsonResponse|RedirectResponse
    {
        $this->validator($request->all())->validate();

        $this->resetPasswordConfirmationTimeout($request);

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    protected function resetPasswordConfirmationTimeout(Request $request): void
    {
        $request->session()->put('auth.password_confirmed_at', time());
    }

    /**
     * Get the password confirmation validation rules.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'password' => 'required|current_password:web',
        ];
    }
}
