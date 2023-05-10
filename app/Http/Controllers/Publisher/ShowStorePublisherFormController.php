<?php

namespace App\Http\Controllers\Publisher;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\State\LoadStates;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowStorePublisherFormController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        private readonly LoadStates $loadStates
    )
    {
    }

    protected function getTable(): string
    {
        return 'publishers';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $loadStatesResult = $this->loadStates->execute();

            if ($loadStatesResult->isRejected()) {
                $this->alertDanger($loadStatesResult->getMessage());
                $return = back()->with(
                    $this->getAlerts(),
                );
            } else {
                $return = view('publisher.store', array_merge(
                    $this->getAlerts(),
                    $this->getRecordArgs(),
                    ['states' => $loadStatesResult->get()]
                ));
            }
        } catch (Exception) {
            abort(404);
        }

        return $return;
    }
}
