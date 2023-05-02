<?php

namespace App\Http\Controllers\Author;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Domain\UseCases\Author\LoadAuthorById;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowEditAuthorFormController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        private readonly LoadAuthorById $loadUserById
    )
    {
    }

    public function getTable(): string
    {
        return 'authors';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $findResult = $this->loadUserById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            $return = view('author.edit', array_merge(
                $this->getAlerts(),
                $this->getRecordArgs(),
                [
                    'record' => $findResult->get()
                ]
            ));

        } catch (Exception) {
            $return = back()->with(array_merge(
                $this->getAlerts(),
                [
                    'danger' => 'Do not possible to edit this record',
                ]
            ));
        }
        return $return;
    }
}
