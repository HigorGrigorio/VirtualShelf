<?php

namespace App\Http\Controllers\Publisher;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasPaginationArguments;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Publisher\PaginatePublishers;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoadPublishersController extends Controller implements IController
{
    use HasRecordArguments, HasPaginationArguments, AlertsUser;

    public function __construct(
        private readonly PaginatePublishers $loadPublishers
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
            $args = $this->getArgsOfPagination($request);
            $result = $this->loadPublishers
                ->setArgs($args)
                ->execute();

            if ($result->isRejected()) {
                $return = back()->withErrors([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $pagination = $result->get();
                $return = view('publisher.index', compact('pagination'))->with(array_merge(
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
