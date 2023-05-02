<?php

namespace App\Http\Controllers\Auth\ForgottenPassword;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasValidator;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowResetPasswordController extends Controller implements IController
{
    use AlertsUser, HasValidator;

    protected function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email:exists:users',
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $return = view('auth.passwords.reset', [
                'token' => $request->input('token'), 'email' => $request->input('email')
            ])->with($this->getAlerts());
        } catch (Exception $e) {
            $this->alertDanger($e->getMessage());
            $return = back();
        }
        return $return;
    }
}
