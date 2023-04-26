<?php

namespace App\Http\Controllers\Category;

use App\Core\Infra\IController;
use App\Domain\UseCases\Category\LoadCategories;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasPaginationArguments;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class LoadCategoriesController extends Controller implements IController
{
    use HasRecordArguments, HasPaginationArguments;

    public function __construct(
        private readonly LoadCategories $loadCategories
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
    public function handle(Request $request)
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
                $return = view('category.index', compact('pagination'))->with(
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
