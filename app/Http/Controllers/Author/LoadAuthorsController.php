<?php

namespace App\Http\Controllers\Author;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasPaginationArguments;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Author\LoadAuthors;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoadAuthorsController extends Controller implements IController
{
    use HasPaginationArguments, HasRecordArguments;

    public function __construct(
        private readonly LoadAuthors $loadAllAuthors
    )
    {
    }

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
            $args = $this->getArgsOfPagination($request);
            $result = $this->loadAllAuthors
                ->setArgs($args)
                ->execute();

            if ($result->isRejected()) {
                $return = back()->withErrors([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $pagination = $result->get();
                $return = view('author.index', compact('pagination'))->with(
                    $this->getParams(
                        $request,
                        $this->getRecordArgs(),
                        $args
                    ),
                );
            }
        } catch (Exception $e) {
            $return = back()->with([
                'danger' => $e->getMessage()
            ]);
        }

        return $return;
    }
}
