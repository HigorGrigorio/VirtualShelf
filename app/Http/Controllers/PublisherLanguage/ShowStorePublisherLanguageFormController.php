<?php

namespace App\Http\Controllers\PublisherLanguage;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Language\LoadLanguages;
use App\Domain\UseCases\Publisher\LoadPublishers;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowStorePublisherLanguageFormController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        public readonly LoadLanguages  $loadLanguages,
        public readonly LoadPublishers $loadPublishers,
    )
    {
    }

    protected function getTable(): string
    {
        return 'publishers_languages';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
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
            } else {
                $return = view('publisher_language.store', array_merge(
                    $this->getAlerts(),
                    $this->getRecordArgs(),
                    [
                        'publishers' => $loadPublishers->get(),
                        'languages' => $loadLanguages->get()
                    ]
                ));
            }
        } catch (Exception) {
            abort(404);
        }

        return $return;
    }
}
