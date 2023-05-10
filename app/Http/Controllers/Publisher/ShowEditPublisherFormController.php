<?php

namespace App\Http\Controllers\Publisher;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Country\LoadCountries;
use App\Domain\UseCases\Publisher\LoadPublisherById;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowEditPublisherFormController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        private readonly LoadPublisherById $loadPublisherById,
        private readonly LoadCountries $loadCountries
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
            $findPublisherResult = $this->loadPublisherById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();

            $findCountriesResult = $this->loadCountries->execute();


            if ($findPublisherResult->isRejected() || $findCountriesResult->isRejected()) {
                abort(404);
            }

            $return = view('publisher.edit', array_merge(
                $this->getAlerts(),
                $this->getRecordArgs(),
                [
                    'record' => $findPublisherResult->get(),
                    'countries' => $findCountriesResult->get(),
                ]
            ));
        } catch (Exception) {
            $return = back()->with(array_merge(
                    $this->getAlerts(),
                    [
                        'danger' => 'Do not possible to edit this record',
                    ])
            );
        }
        return $return;
    }
}
