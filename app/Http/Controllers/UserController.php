<?php

namespace App\Http\Controllers;

use App\Core\Logic\Result;
use App\Domain\UseCases\User\CreateUser;
use App\Domain\UseCases\User\DeleteUserById;
use App\Domain\UseCases\User\LoadUserById;
use App\Domain\UseCases\User\LoadUsers;
use App\Domain\UseCases\User\UpdateUser;
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
    public string $table = 'users';

    public function __construct(
        private readonly LoadUsers      $loadUsers,
        private readonly CreateUser     $createUser,
        private readonly UpdateUser     $updateUser,
        private readonly LoadUserById   $loadUser,
        private readonly DeleteUserById $deleteUser,
    )
    {
    }

    public function index(Request $request): View|RedirectResponse
    {
        try {
            $this->setRequest($request);
            $this->setResult($this->loadUsers->execute($this->getPaginationParams()));
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

    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $args = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'photo' => $request->file('photo'),
                'password_confirmation' => $request->input('password_confirmation'),
            ];
            $this->setRequest($request);
            $result = $this->createUser->execute($args);
            $this->setResult($result);
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }

    public function show(Request $request): Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try {
            $args = [
                'id' => $request->route('id'),
            ];
            $this->setRequest($request);
            $this->setResult($this->loadUser->execute($args));
            $view = $this->makeView('show');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function edit(Request $request): Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try {
            $args = [
                'id' => $request->route('id'),
            ];
            $this->setRequest($request);
            $this->setResult($this->loadUser->execute($args));
            $this->setResult($this->loadUser->execute($args));
            $view = $this->makeView('edit');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function update(UpdateUserRequest $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        try {
            $args = [
                'id' => $request->route('id'),
                'name' => $request->input('name'),
                'photo' => $request->file('photo'),
                'email' => $request->input('email'),
                'remove_photo' => (bool)$request->input('remove_photo'),
            ];
            $this->setRequest($request);
            $this->setResult($this->updateUser->execute($args));
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
            $this->setResult($this->deleteUser->execute(['id' => $id]));
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }
}
