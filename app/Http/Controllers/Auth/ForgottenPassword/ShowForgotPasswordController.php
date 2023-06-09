<?php

namespace App\Http\Controllers\Auth\ForgottenPassword;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowForgotPasswordController extends Controller implements IController
{
    use AlertsUser;

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $return = view('auth.passwords.email', $this->getAlerts());
        } catch (Exception $e) {
            $this->alertDanger($e->getMessage());
            $return = back()->withInput();
        }
        return $return;
    }
}
