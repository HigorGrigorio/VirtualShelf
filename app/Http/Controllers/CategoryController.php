<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Category\CreateCategory;
use App\Domain\UseCases\Category\DeleteCategoryById;
use App\Domain\UseCases\Category\LoadCategories;
use App\Domain\UseCases\Category\LoadCategoryById;
use App\Domain\UseCases\Category\UpdateCategory;
use App\Http\Controllers\Traits\DestroysRecords;
use App\Http\Controllers\Traits\EditsRecords;
use App\Http\Controllers\Traits\HandlesRecords;
use App\Http\Controllers\Traits\LoadsRecords;
use App\Http\Controllers\Traits\StoresRecords;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{
    use LoadsRecords, StoresRecords, EditsRecords, DestroysRecords, HandlesRecords;

    public string $table = 'categories';

    /**
     * The columns that will be displayed in the table.
     *
     * @var array $columns
     */
    public array $columns = [
        'id' => '#',
        'name' => 'Name',
        'slug' => 'Slug',
        'description' => 'Description',
        'actions' => [
            'label' => 'Actions',
            'edit' => [
                'route' => 'tables.category.edit',
                'params' => ['id' => 'id']
            ],
            'delete' => [
                'route' => 'tables.category.destroy',
                'params' => ['id' => 'id']
            ]
        ]
    ];

    public function __construct(
        private readonly CreateCategory     $createCategory,
        private readonly LoadCategories     $loadCategories,
        private readonly LoadCategoryById   $loadCategory,
        private readonly UpdateCategory     $updateCategory,
        private readonly DeleteCategoryById $deleteCategory,
    )
    {
        $this->setUseCases([
            'create' => $this->createCategory,
            'index' => $this->loadCategories,
            'load' => $this->loadCategory,
            'update' => $this->updateCategory,
            'delete' => $this->deleteCategory,
        ]);
    }

    /**
     * @throws Exception
     */
    public function index(Request $request): LaravelApplication|Factory|View|RedirectResponse|Application
    {
        return $this->indexImpl($request);
    }

    /**
     * @throws Exception
     */
    public function create(Request $request): Factory|View|Application
    {
        return $this->createImpl($request);
    }

    /**
     * @throws Exception
     */
    public function edit(Request $request, $id): Factory|View|Application
    {
        return $this->editImpl($request, $id);
    }

    /**
     * @throws Exception
     */
    public function destroy(Request $request, int $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        return $this->destroyImpl($request, $id);
    }

    /**
     * @throws Exception
     */
    public function store(StoreCategoryRequest $request): Application|LaravelApplication|RedirectResponse|Redirector
    {
        return $this->storeImpl($request);
    }

    /**
     * @throws Exception
     */
    public function update(UpdateCategoryRequest $request, int $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        return $this->updateImpl($request, $id);
    }
}
