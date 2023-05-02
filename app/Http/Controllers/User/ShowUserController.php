<?php

namespace App\Http\Controllers\User;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Domain\UseCases\User\LoadUserById;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowUserController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        private readonly LoadUserById $loadUserById
    )
    {
    }

    // for record arguments
    public function getTable(): string
    {
        return 'users';
    }

    /**
     * @inheritDoc
     */
    public
    function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $findResult = $this->loadUserById
                ->setArgs([
                    'id' => $request->route('id')
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            return view('user.show', array_merge(
                $this->getAlerts(),
                $this->getRecordArgs(),
                [
                    'record' => $findResult->get()
                ]
            ));
        } catch (Exception $e) {
            return back()->with(array_merge(
                $this->getAlerts(),
                [
                    'danger' => "Don't is possible show this user"
                ])
            );
        }
    }
}
