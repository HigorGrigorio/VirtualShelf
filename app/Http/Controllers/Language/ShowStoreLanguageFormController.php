<?php

namespace App\Http\Controllers\Language;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowStoreLanguageFormController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    protected function getTable(): string
    {
        return 'languages';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            return view('language.store', array_merge(
                $this->getAlerts(),
                $this->getRecordArgs(),

            ));
        } catch (Exception) {
            abort(404);
        }
    }
}
