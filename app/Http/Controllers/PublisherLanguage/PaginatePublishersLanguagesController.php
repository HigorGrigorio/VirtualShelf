<?php

namespace App\Http\Controllers\PublisherLanguage;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasPaginationArguments;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\PublisherLanguage\PaginatePublisherLanguages;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaginatePublishersLanguagesController extends Controller implements IController
{
    use HasPaginationArguments, HasRecordArguments, AlertsUser;

    public function __construct(
        public readonly PaginatePublisherLanguages $paginatePublisherLanguages
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
    public function handle(Request $request): View|Application|Factory|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $args = $this->getArgsOfPagination($request);
            $result = $this->paginatePublisherLanguages
                ->setArgs($args)
                ->execute();

            if ($result->isRejected()) {
                $return = back()->withErrors([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $pagination = $result->get();

                $return = view('publisher_language.index', compact('pagination'))->with(array_merge(
                    $this->getRecordArgs(),
                    $this->getAlerts(),
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
