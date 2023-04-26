<?php

namespace App\Http\Controllers\Category;

use App\Domain\UseCases\Category\LoadCategoryById;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowCategoryController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    use HasRecordArguments;

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
    public function handle(Request $request)
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

            $return = view('category.show')->with($this->getParams(
                $request,
                $this->getRecordArgs(),
                [
                    'record' => $findResult->get()
                ]
            ));
        } catch (Exception) {
            $return = back()->with([
                'danger' => "Don't is possible show category"
            ]);
        }
        return $return;
    }
}
