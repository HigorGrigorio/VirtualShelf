<?php

namespace App\Http\Controllers\User;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasPaginationArguments;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\User\LoadUsers;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoadUsersController extends Controller implements IController
{
    use HasPaginationArguments, HasRecordArguments, AlertsUser;

    public function __construct(
        private readonly LoadUsers $loadUser
    )
    {
    }

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
            $args = $this->getArgsOfPagination($request);
            $result = $this->loadUser
                ->setArgs($args)
                ->execute();

            if ($result->isRejected()) {
                $return = back()->withErrors([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $pagination = $result->get();
                $return = view('user.index', compact('pagination'))->with(array_merge(
                    $this->getAlerts(),
                    $this->getRecordArgs(),
                    $args
                ));
            }
        } catch (Exception $e) {
            $return = back()->with([
                'danger' => $e->getMessage()
            ]);
        }

        return $return;
    }
}
