<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Author\CreateAuthor;
use App\Domain\UseCases\Author\DeleteAuthorById;
use App\Domain\UseCases\Author\LoadAuthorById;
use App\Domain\UseCases\Author\LoadAuthors;
use App\Domain\UseCases\Author\UpdateAuthor;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;

class AuthorController extends Controller
{
    public function __construct(
        private readonly LoadAuthors  $loadAuthors,
        private readonly CreateAuthor $createAuthor,
        private readonly UpdateAuthor $updateAuthor,
        private readonly LoadAuthorById $loadAuthor,
        private readonly DeleteAuthorById $deleteAuthor,
    )
    {
    }

    public function index(Request $request)
    {
        $options = [
            'page' => $request->page ?? 1,
            'limit' => $request->limit ?? 10,
            'search' => $request->search ?? ''
        ];

        $result = $this->loadAuthors->execute($options);

        $view = view('pages.author.index');

        if ($result->isRejected()) {
            $this->danger($result->getMessage(), 'Internal Server Error');
        } else {
            $view->with([
                'pagination' => $result->get(),
            ]);
        }

        $view->with([
            'search' => $options['search'] ?? '',
            'limit' => $options['limit'] ?? Config::get('app.pagination.per_page'),
            'limits' => Config::get('app.pagination.limits'),
        ]);

        return $view;
    }

    public function create(): \Illuminate\Contracts\View\View|LaravelApplication|\Illuminate\Contracts\View\Factory|Application
    {
        return view('pages.author.store');
    }

    public function store(AuthorRequest $request): RedirectResponse
    {
        $options = [
            'name' => $request->name,
            'surname' => $request->surname,
        ];

        $result = $this->createAuthor->execute($options);

        if ($result->isRejected()) {
            $this->danger($result->getMessage(), 'Internal Server Error');
            return redirect()->back()->withInput();
        }

        $this->success($result->getMessage(), 'Success');
        return redirect()->route('pages.author.index');
    }

    public function edit($id): \Illuminate\Contracts\View\View|LaravelApplication|\Illuminate\Contracts\View\Factory|Application
    {
        $result = $this->loadAuthor->execute(['id' => $id]);


        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect('table/authors');
        }

        $author = $result->get();

        return view('pages.author.edit')->with([
            'model' => $author,
        ]);
    }

    public function update($id, UpdateAuthorRequest $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        $raw = [
            'id' => $id,
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ];

        $result = $this->updateAuthor
            ->execute($raw);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect()->back();
        }

        $this->success($result->getMessage());

        return redirect()->route('pages.author.index');
    }

    public function destroy(int $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        $result = $this->deleteAuthor->execute(['id' => $id]);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect('table/authors');
        }

        $this->success($result->getMessage());

        return redirect('table/authors');
    }
}
