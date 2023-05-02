<?php

namespace App\Http\Controllers\Auth\Verification;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ShowVerification extends Controller implements IController
{
    use AlertsUser;

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $return = view('auth.verify', $this->getAlerts());
        } catch (Exception $th) {
            $this->alertDanger($th->getMessage());
            $return = back()->withInput();
        }
        return $return;
    }
}
