<?php

namespace App\Http\Controllers\PublisherLanguage;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Language\LoadLanguages;
use App\Domain\UseCases\Publisher\LoadPublishers;
use App\Domain\UseCases\PublisherLanguage\LoadPublisherLanguageById;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowEditPublisherLanguageFormController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        private readonly LoadPublisherLanguageById $loadPublisherLanguageById,
        private readonly LoadLanguages             $loadLanguages,
        private readonly LoadPublishers            $loadPublishers,
    )
    {
    }


    public function getTable(): string
    {
        return 'publishers_languages';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $findPublisherResult = $this->loadPublisherLanguageById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();
            $loadLanguages = $this->loadLanguages->execute();
            $loadPublishers = $this->loadPublishers->execute();

            if ($loadLanguages->isRejected()) {
                $this->alertDanger($loadLanguages->getMessage());
                $return = back()->with(
                    $this->getAlerts(),
                );
            } else if ($loadPublishers->isRejected()) {
                $this->alertDanger($loadPublishers->getMessage());
                $return = back()->with(
                    $this->getAlerts(),
                );
            } else if ($findPublisherResult->isRejected()) {
                $this->alertDanger($findPublisherResult->getMessage());
                $return = back()->with(
                    $this->getAlerts(),
                );
            } else {
                $return = view('publisher_language.edit', array_merge(
                    $this->getAlerts(),
                    $this->getRecordArgs(),
                    [
                        'record' => $findPublisherResult->get(),
                        'publishers' => $loadPublishers->get(),
                        'languages' => $loadLanguages->get()
                    ]
                ));
            }
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
