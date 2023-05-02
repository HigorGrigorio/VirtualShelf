<?php

namespace App\Http\Controllers\Auth\Login;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ShowLoginController extends Controller implements IController
{
    use AlertsUser;

    /**
     * @inheritDoc
     */
    public function handle(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.login', $this->getAlerts());
    }
}
