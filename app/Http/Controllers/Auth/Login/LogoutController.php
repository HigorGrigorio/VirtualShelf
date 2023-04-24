<?php

namespace App\Http\Controllers\Auth\Login;

use App\Core\Infra\IController;
use App\Http\Controllers\Auth\HasGuardMethods;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller implements IController
{
    use HasGuardMethods;

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
