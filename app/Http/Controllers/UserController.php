<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\User\CreateUser;
use App\Domain\UseCases\User\DeleteUserById;
use App\Domain\UseCases\User\LoadUserById;
use App\Domain\UseCases\User\LoadUsers;
use App\Domain\UseCases\User\UpdateUser;
use App\Http\Controllers\Traits\DestroysRecords;
use App\Http\Controllers\Traits\EditsRecords;
use App\Http\Controllers\Traits\HandlesRecords;
use App\Http\Controllers\Traits\LoadsRecords;
use App\Http\Controllers\Traits\StoresRecords;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    use LoadsRecords, StoresRecords, EditsRecords, DestroysRecords, HandlesRecords;

    public string $table = 'users';

    public array $showable = [
        'name',
        'email',
        'photo'
    ];

    /**
     * The columns that will be displayed in the table.
     *
     * @var array $columns
     */
    public array $columns = [
        'id' => '#',
        'user' => [
            'label' => 'User',
            'type' => 'html',
            'bind' => ['icon', 'name', 'email'],
            'value' => '<div class="d-flex">
                            <div>
                                <img src="/images/default-photo.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">${name}</h6>
                                <p class="text-xs text-secondary mb-0">${email}</p>
                            </div>
                        </div>',
        ],
        'actions' => [
            'label' => 'Actions',
            'edit' => [
                'route' => 'tables.user.edit',
                'params' => ['id' => 'id']
            ],
            'delete' => [
                'route' => 'tables.user.destroy',
                'params' => ['id' => 'id']
            ]
        ],
    ];

    public array $helps = [
        'name' => 'The name of the user. This is the name that will be displayed in the application.',
        'email' => 'The email of the user.',
    ];

    public function __construct(
        private readonly LoadUsers      $loadUsers,
        private readonly CreateUser     $createUser,
        private readonly UpdateUser     $updateUser,
        private readonly LoadUserById   $loadUser,
        private readonly DeleteUserById $deleteUser,
    )
    {
        $this->setUseCases([
            'index' => $this->loadUsers,
            'create' => $this->createUser,
            'update' => $this->updateUser,
            'load' => $this->loadUser,
            'delete' => $this->deleteUser,
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
    public function store(StoreUserRequest $request): RedirectResponse
    {
        return $this->storeImpl($request);
    }

    /**
     * @throws Exception
     */
    public function update(UpdateUserRequest $request, int $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        return $this->updateImpl($request, $id);
    }
}
