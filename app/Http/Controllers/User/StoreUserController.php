<?php

namespace App\Http\Controllers\User;

use App\Domain\UseCases\User\CreateUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreUserController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    public function __construct(
        private readonly CreateUser $createUser
    )
    {
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required',
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $this->validate($request, $this->rules());

            $result = $this->createUser
                ->setArgs([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'photo' => $request->file('photo')
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.user.index')->with([
                    'success' => $result->getMessage()
                ]);
            }
        } catch (ValidationException $e) {
            $return = back()->with([
                'danger' => 'Validation errors'
            ])->withErrors($e->errors());
        } catch (Exception $e) {
            $return = back()->withErrors([
                'danger' => $e->getMessage()
            ]);
        }
        return $return;
    }
}
