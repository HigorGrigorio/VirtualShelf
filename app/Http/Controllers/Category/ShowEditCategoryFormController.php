<?php

namespace App\Http\Controllers\Category;

use App\Domain\UseCases\Category\LoadCategoryById;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowEditCategoryFormController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly LoadCategoryById $loadCategoryById
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
            $findResult = $this->loadCategoryById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            $return = view('category.edit')->with(
                $this->getParams($request,
                    [
                        'record' => $findResult->get(),
                    ],
                    $this->getRecordArgs()
                )
            );
        } catch (Exception) {
            $return = back()->with(
                $this->getParams($request, [
                    'danger' => 'Do not possible to edit this record',
                ])
            );
        }
        return $return;
    }
}
