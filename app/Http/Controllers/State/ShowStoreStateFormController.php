<?php

namespace App\Http\Controllers\State;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Country\LoadCountries;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowStoreStateFormController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        private readonly LoadCountries $loadCountries
    )
    {
    }

    protected function getTable(): string
    {
        return 'states';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $loadCountriesResult = $this->loadCountries->execute();

            if ($loadCountriesResult->isRejected()) {
                $this->alertDanger($loadCountriesResult->getMessage());
                $return = back()->with(
                    $this->getAlerts(),
                );
            } else {
                $return = view('state.store', array_merge(
                    $this->getAlerts(),
                    $this->getRecordArgs(),
                    ['countries' => $loadCountriesResult->get()]
                ));
            }
        } catch (Exception) {
            abort(404);
        }

        return $return;
    }
}
