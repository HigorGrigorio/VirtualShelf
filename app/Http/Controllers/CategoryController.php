<?php

namespace App\Http\Controllers;

use App\Core\Logic\Result;
use App\Domain\UseCases\Category\CreateCategory;
use App\Domain\UseCases\Category\DeleteCategoryById;
use App\Domain\UseCases\Category\LoadCategories;
use App\Domain\UseCases\Category\LoadCategoryById;
use App\Domain\UseCases\Category\UpdateCategory;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{
    public string $table = 'categories';

    public function __construct(
        private readonly CreateCategory     $createCategory,
        private readonly LoadCategories     $loadCategories,
        private readonly LoadCategoryById   $loadCategory,
        private readonly UpdateCategory     $updateCategory,
        private readonly DeleteCategoryById $deleteCategory,
    )
    {
    }

    public function index(Request $request): View|RedirectResponse
    {
        try {
            $this->setRequest($request);
            $this->setResult($this->loadCategories->execute($this->getPaginationParams()));
            $view = $this->makeView('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function create(): Application|Factory|View|LaravelApplication
    {
        return $this->makeView('store');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        try {
            $args = [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description'),
            ];
            $this->setRequest($request);
            $result = $this->createCategory->execute($args);
            $this->setResult($result);
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }

    public function edit(Request $request): Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try {
            $args = [
                'id' => $request->route('id'),
            ];
            $this->setRequest($request);
            $this->setResult($this->loadCategory->execute($args));
            $this->setResult($this->loadCategory->execute($args));
            $view = $this->makeView('edit');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function show(Request $request): Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try {
            $args = [
                'id' => $request->route('id'),
            ];
            $this->setRequest($request);
            $this->setResult($this->loadCategory->execute($args));
            $view = $this->makeView('show');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function update(UpdateCategoryRequest $request):Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try{
            $args = [
                'id' => $request->route('id') ,
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description'),
            ];
            $this->setRequest($request);
            $this->setResult($this->updateCategory->execute($args));
            $redirect = $this->redirect('index');
        }  catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }

    public function destroy(Request $request): Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try {
            $id = $request->route('id');
            $this->setRequest($request);
            $this->setResult($this->deleteCategory->execute(['id' => $id]));
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }
}
