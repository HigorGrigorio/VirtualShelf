<?php

namespace App\Http\Controllers\Auth\Register;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowRegistrationController extends Controller implements IController
{
    use AlertsUser;

    public function handle(Request $request)
    {
        try {
            $return = view('auth.register', $this->getAlerts());
        } catch (\Exception $th) {
            $this->alertDanger($th->getMessage());
            $return = back()->withInput();
        }

        return $return;
    }
}
