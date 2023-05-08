<?php

namespace App\Http\Controllers\Language;

use App\Core\Infra\IController;
use App\Domain\UseCases\Language\UpdateLanguage;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateLanguageController extends Controller implements IController
{

    public function __construct(
        private readonly UpdateLanguage $updateLanguage
    )
    {
    }

    public function rules($id): array
    {

        return [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('languages')->ignore($id),
            ],
            'acronym' => [
                'required',
                'string',
                'max:3',
                Rule::unique('languages')->ignore($id),
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $this->validate($request, $this->rules($request->route('id')));

            $result = $this->updateLanguage
                ->setArgs([
                    'id' => $request->route('id'),
                    'name' => $request->input('name'),
                    'acronym' => $request->input('acronym'),
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.language.index')->with(
                    [
                        'success' => $result->getMessage(),
                    ]
                );
            }
        } catch (ValidationException $e) {
            $return = back()->with([
                'danger' => 'Validation errors',
            ])->withErrors($e->errors());
        } catch (Exception) {
            $return = back()->with([
                'danger' => 'Do not possible to update this record',
            ]);
        }
        return $return;
    }
}
