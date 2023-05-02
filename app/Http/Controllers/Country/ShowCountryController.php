<?php

namespace App\Http\Controllers\Country;

use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Country\LoadCountryById;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowCountryController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        private readonly LoadCountryById $loadCountryById
    )
    {
    }

    public function getTable(): string
    {
        return 'countries';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $findResult = $this->loadCountryById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            $return = view('country.show', array_merge(
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
                        'danger' => "Don't is possible show country"
                    ])
            );
        }
        return $return;
    }
}
