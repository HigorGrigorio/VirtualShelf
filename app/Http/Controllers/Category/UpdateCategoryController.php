<?php

namespace App\Http\Controllers\Category;

use App\Domain\UseCases\Category\UpdateCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateCategoryController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{

    public function __construct(
        private readonly UpdateCategory $updateCategory
    )
    {
    }

    public function rules($id): array
    {

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($id),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($id),
            ],
            'description' => 'required|string|max:512',
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $this->validate($request, $this->rules($request->route('id')));

            $result = $this->updateCategory
                ->setArgs([
                    'id' => $request->route('id'),
                    'name' => $request->input('name'),
                    'slug' => $request->input('slug'),
                    'description' => $request->input('description'),
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.category.index')->with(
                    $this->getParams($request, [
                        'success' => $result->getMessage(),
                    ])
                );
            }
        } catch (ValidationException $e) {
            $return = back()->with([
                'danger' => 'Validation errors',
            ])->withErrors($e->errors());
        } catch (Exception) {
            $return = back()->with([
                'danger' => 'Do not possible to update this record',
            ]);
        }
        return $return;
    }
}
