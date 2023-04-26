<?php

namespace App\Http\Controllers\Category;

use App\Domain\UseCases\Category\CreateCategory;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreCategoryController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly CreateCategory $createCategory
    )
    {
    }

    protected function getTable(): string
    {
        return 'categories';
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|unique:categories|string|max:255',
            'slug' => 'required|unique:categories|string|max:255',
            'description' => 'required|string|max:512',
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $this->validate($request, $this->rules());

            $result = $this->createCategory
                ->setArgs([
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
                $return = redirect()->route('tables.category.index')->with([
                    'success' => $result->getMessage()
                ]);
            }
        } catch (ValidationException $e) {
            $return = back()->withErrors(
                $e->errors()
            );
        } catch (Exception $e) {
            $return = back()->withErrors([
                'danger' => $e->getMessage()
            ]);
        }

        return $return;
    }
}