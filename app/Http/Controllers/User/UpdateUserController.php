<?php

namespace App\Http\Controllers\User;

use App\Core\Infra\IController;
use App\Domain\UseCases\User\UpdateUser;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateUserController extends Controller implements IController
{
    public function __construct(
        private readonly UpdateUser $updateUser
    )
    {
    }

    public function rules($id): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $this->validate($request, $this->rules($request->route('id')));

            $result = $this->updateUser
                ->setArgs([
                    'id' => $request->route('id'),
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'photo' => $request->file('photo')
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.user.index')->with(
                    [
                        'success' => $result->getMessage(),
                    ]
                );
            }
        } catch (ValidationException $e) {
            $return = back()->with(
                ['danger' => 'Validation errors']
            )->withErrors($e->errors());
        } catch (Exception) {
            $return = back()->with([
                'danger' => 'Do not possible to update this record',
            ]);
        }
        return $return;
    }
}
