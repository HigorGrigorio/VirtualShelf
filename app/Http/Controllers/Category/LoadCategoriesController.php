<?php

namespace App\Http\Controllers\Category;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasPaginationArguments;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Category\PaginateCategories;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoadCategoriesController extends Controller implements IController
{
    use HasRecordArguments, HasPaginationArguments, AlertsUser;

    public function __construct(
        private readonly PaginateCategories $loadCategories
    )
    {
    }

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
            $args = $this->getArgsOfPagination($request);
            $result = $this->loadCategories
                ->setArgs($args)
                ->execute();

            if ($result->isRejected()) {
                $return = back()->withErrors([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $pagination = $result->get();
                $return = view('category.index', compact('pagination'))->with(array_merge(
                    $this->getAlerts(),
                    $this->getRecordArgs(),
                    $args
                ));
            }
        } catch (Exception $e) {
            $return = back()->with([
                'danger' => $e->getMessage()
            ]);
        }

        return $return;
    }
}
