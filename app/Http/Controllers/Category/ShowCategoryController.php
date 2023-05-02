<?php

namespace App\Http\Controllers\Category;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Domain\UseCases\Category\LoadCategoryById;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowCategoryController extends Controller implements IController
{
    use HasRecordArguments, AlertsUser;

    public function __construct(
        public readonly LoadCategoryById $loadCategoryById
    )
    {
    }

    // for records arguments
    public function getTable(): string
    {
        return 'categories';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $findResult = $this->loadCategoryById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            $return = view('category.show', array_merge(
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
                        'danger' => "Don't is possible show category"
                    ])
            );
        }
        return $return;
    }
}
