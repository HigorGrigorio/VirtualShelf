<?php

namespace App\Http\Controllers\Publisher;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Publisher\LoadPublisherById;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowPublisherController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        private readonly LoadPublisherById $loadPublisherById
    )
    {
    }

    public function getTable(): string
    {
        return 'publishers';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $findResult = $this->loadPublisherById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            $return = view('publisher.show', array_merge(
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
                        'danger' => "Don't is possible show publisher"
                    ])
            );
        }
        return $return;
    }
}
