<?php

namespace App\Http\Controllers\Auth\ConfirmPassword;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowConfirmPasswordController extends Controller implements IController
{
    use AlertsUser;

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $this->alertInfo('This is a password confirmation screen. Please confirm your password before continuing.');
            $return = view('auth.passwords.confirm', $this->getAlerts());
        } catch (Exception $e) {
            $this->alertDanger($e->getMessage());
            $return = back();
        }
        return $return;
    }
}
