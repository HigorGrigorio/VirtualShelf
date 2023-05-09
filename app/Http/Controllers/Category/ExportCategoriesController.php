<?php

namespace App\Http\Controllers\Category;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasValidator;
use App\Domain\UseCases\Author\ExportAuthors;
use App\Domain\UseCases\Category\ExportCategories;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ExportCategoriesController extends Controller implements IController
{
    use HasValidator;

    public function __construct(
        readonly ExportCategories $exportCategories
    )
    {
        $this->middleware('auth');
    }


    protected function rules(): array
    {
        return [
            'format' => 'required|in:csv,xls,xlsx,pdf'
        ];
    }

    protected function messages(): array
    {
        return [
            'format.required' => 'The format field is required',
            'format.in' => 'The format field must be one of the following types: csv, xls, xlsx, pdf',
        ];
    }

    protected function attributes(Request $request): array
    {
        return [
            'columns' => [
                'id',
                'name',
                'slug',
                'description',
                'created_at',
                'updated_at'
            ],
            'format' => $request->route('format'),
            'view' => [
                'name' => 'exports.pdf',
                'title' => 'Categories',
                'attributes' => [
                    'Id',
                    'Name',
                    'Slug',
                    'Description',
                    'Created At',
                    'Updated At'
                ]
            ],
            'filename' => 'categories',
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $this->validator(['format' => $request->route('format')])
                ->validate();

            $result = $this->exportCategories
                ->setArgs($this->attributes($request))
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = $result->get();
            }
        } catch (Exception $e) {
            $return = back()->with(
                $e->getMessage()
            );
        }

        return $return;
    }
}
