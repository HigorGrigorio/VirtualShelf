<?php

namespace App\Http\Controllers\Author;

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

class ShowStoreAuthorFormController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

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
            $return = view('author.store', $this->getAlerts())
                ->with(
                    $this->getRecordArgs(),
                );
        } catch (Exception) {
            abort(404);
        }
        return $return;
    }
}
