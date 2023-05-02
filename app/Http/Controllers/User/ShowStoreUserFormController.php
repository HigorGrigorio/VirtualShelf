<?php

namespace App\Http\Controllers\User;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowStoreUserFormController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function getTable(): string
    {
        return 'users';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            return view('user.store', array_merge(
                $this->getAlerts(),
                $this->getRecordArgs(),
            ));
        } catch (Exception) {
            abort(404);
        }
    }
}
