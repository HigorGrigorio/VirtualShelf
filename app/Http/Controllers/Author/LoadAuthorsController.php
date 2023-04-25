<?php

namespace App\Http\Controllers\Author;

use App\Core\Infra\IController;
use App\Domain\UseCases\Author\LoadAuthors;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasPaginationArguments;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
    public function handle(Request $request)
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
