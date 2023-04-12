<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Category\CreateCategory;
use App\Domain\UseCases\Category\DeleteCategoryById;
use App\Domain\UseCases\Category\LoadCategories;
use App\Domain\UseCases\Category\LoadCategoryById;
use App\Domain\UseCases\Category\UpdateCategory;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
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
    public function __construct(
        private readonly CreateCategory     $createCategory,
        private readonly LoadCategories     $loadCategories,
        private readonly LoadCategoryById   $loadCategory,
        private readonly UpdateCategory     $updateCategory,
        private readonly DeleteCategoryById $deleteCategory,
    )
    {
    }

    public function index(Request $request): Application|Factory|View|LaravelApplication|JsonResponse
    {
        $options = [
            'page' => $request->page ?? 1,
            'limit' => $request->limit ?? 10,
            'search' => $request->search ?? ''
        ];

        $result = $this->loadCategories
            ->execute($options);

        if ($result->isRejected()) {
            $this->danger($result->getMessage(), 'Internal Server Error');

            $view = view('pages.category.index');
        } else {
            if ($result->get()->count() == 0) {
                $this->info('No categories found');
            }
            $view = view('pages.category.index')->with([
                'pagination' => $result->get(),
            ]);
        }

        $view->with([
            'search' => $options['search'],
            'limit' => $options['limit'],
            'limits' => [10, 25, 50, 100],
        ]);

        return $view;
    }

    public function create(): Application|Factory|View|LaravelApplication
    {
        return view('pages.category.store');
    }

    public function store(StoreCategoryRequest $request): Application|LaravelApplication|RedirectResponse|Redirector
    {
        $raw = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ];


        $result = $this->createCategory
            ->execute($raw);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect('tables.category.store');
        }

        $this->success($result->getMessage());

        return redirect()->route('pages.category.index');
    }

    public function edit(int $id): RedirectResponse|Application|Factory|View|LaravelApplication
    {
        $result = $this->loadCategory->execute(['id' => $id]);


        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect()->back();
        }

        $category = $result->get();

        return view('pages.category.edit')->with([
            'model' => $category,
        ]);
    }

    public function update(int $id, UpdateCategoryRequest $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        $raw = [
            'id' => $id,
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ];

        $result = $this->updateCategory
            ->execute($raw);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect()->back();
        }

        $this->success($result->getMessage());

        return redirect()->route('tables.category.index');
    }

    public function destroy(int $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        $result = $this->deleteCategory->execute(['id' => $id]);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect()->back();
        }

        $this->success($result->getMessage());

        return redirect()->route('tables.category.index');
    }
}
