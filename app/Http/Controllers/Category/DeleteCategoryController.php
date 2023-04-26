<?php

namespace App\Http\Controllers\Category;

use App\Core\Infra\IController;
use App\Domain\UseCases\Category\DeleteCategoryById;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class DeleteCategoryController extends Controller implements IController
{
    public function __construct(
        private readonly DeleteCategoryById $deleteCategoryById
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $deleteResult = $this->deleteCategoryById
                ->setArgs([
                    'id' => $request->route('id')
                ])
                ->execute();

            if ($deleteResult->isRejected()) {
                throw new Exception($deleteResult->getMessage());
            }

            $result = redirect()->route('tables.category.index')->with([
                'success' => $deleteResult->getMessage()
            ]);
        } catch (Exception $e) {
            $result = back()->with([
                'danger' => $e->getMessage()
            ]);
        }
        return $result;
    }
}
