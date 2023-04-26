<?php

namespace App\Http\Controllers\Category;

use App\Domain\UseCases\Category\LoadCategoryById;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowStoreCategoryFormController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly LoadCategoryById $loadCategoryById
    )
    {
    }

    protected function getTable(): string
    {
        return 'categories';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            return view('category.store', $this->getParams(
                $request,
                $this->getRecordArgs()
            ));
        } catch (Exception $e) {
            abort(404);
        }
    }
}
