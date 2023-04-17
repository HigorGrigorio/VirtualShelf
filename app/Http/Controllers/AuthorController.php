<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Author\CreateAuthor;
use App\Domain\UseCases\Author\DeleteAuthorById;
use App\Domain\UseCases\Author\LoadAuthorById;
use App\Domain\UseCases\Author\LoadAuthors;
use App\Domain\UseCases\Author\UpdateAuthor;
use App\Http\Controllers\Traits\DestroysRecords;
use App\Http\Controllers\Traits\EditsRecords;
use App\Http\Controllers\Traits\HandlesRecords;
use App\Http\Controllers\Traits\LoadsRecords;
use App\Http\Controllers\Traits\StoresRecords;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;

class AuthorController extends Controller
{
    use LoadsRecords, StoresRecords, EditsRecords, DestroysRecords, HandlesRecords;

    public string $table = 'authors';

    /**
     * The columns that will be displayed in the table.
     *
     * @var array $columns
     */
    public array $columns = [
        'id' => '#',
        'name' => 'Name',
        'surname' => 'Surname',
        'actions' => [
            'label' => 'Actions',
            'edit' => [
                'route' => 'tables.author.edit',
                'params' => ['id' => 'id']
            ],
            'delete' => [
                'route' => 'tables.author.destroy',
                'params' => ['id' => 'id']
            ]
        ]
    ];

    public function __construct(
        private readonly LoadAuthors      $loadAuthors,
        private readonly CreateAuthor     $createAuthor,
        private readonly UpdateAuthor     $updateAuthor,
        private readonly LoadAuthorById   $loadAuthor,
        private readonly DeleteAuthorById $deleteAuthor,
    )
    {
        $this->setUseCases([
            'index' => $this->loadAuthors,
            'create' => $this->createAuthor,
            'update' => $this->updateAuthor,
            'load' => $this->loadAuthor,
            'delete' => $this->deleteAuthor,
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
    public function store(StoreAuthorRequest $request): Application|LaravelApplication|RedirectResponse|Redirector
    {
        return $this->storeImpl($request);
    }

    /**
     * @throws Exception
     */
    public function update(UpdateAuthorRequest $request, int $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        return $this->updateImpl($request, $id);
    }
}
