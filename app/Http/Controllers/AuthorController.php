<?php

namespace App\Http\Controllers;

use App\Core\Logic\Result;
use App\Domain\UseCases\Author\CreateAuthor;
use App\Domain\UseCases\Author\DeleteAuthorById;
use App\Domain\UseCases\Author\LoadAuthorById;
use App\Domain\UseCases\Author\LoadAuthors;
use App\Domain\UseCases\Author\UpdateAuthor;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AuthorController extends Controller
{
    public string $table = 'authors';

    public function __construct(
        private readonly LoadAuthors      $loadAuthors,
        private readonly CreateAuthor     $createAuthor,
        private readonly UpdateAuthor     $updateAuthor,
        private readonly LoadAuthorById   $loadAuthor,
        private readonly DeleteAuthorById $deleteAuthor,
    )
    {
    }

    public function index(Request $request): View|RedirectResponse
    {
        try {
            $this->setRequest($request);
            $this->setResult($this->loadAuthors->execute($this->getPaginationParams()));
            $view = $this->makeView('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function create(): View|LaravelApplication|Factory|Application
    {
        return $this->makeView('store');
    }

    public function store(StoreAuthorRequest $request): Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try {
            $params = [
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
            ];
            $this->setRequest($request);
            $result = $this->createAuthor->execute($params);
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
            $this->setResult($this->loadAuthor->execute($args));
            $this->setResult($this->loadAuthor->execute($args));
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
            $this->setResult($this->loadAuthor->execute($args));
            $view = $this->makeView('show');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function update(UpdateAuthorRequest $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        try {
            $args = [
                'id' => $request->route('id'),
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
            ];
            $this->setRequest($request);
            $this->setResult($this->updateAuthor->execute($args));
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }

    public function destroy(Request $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        try {
            $id = $request->route('id');
            $this->setRequest($request);
            $this->setResult($this->deleteAuthor->execute(['id' => $id]));
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }
}
