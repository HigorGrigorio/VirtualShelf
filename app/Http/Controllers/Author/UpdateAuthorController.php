<?php

namespace App\Http\Controllers\Author;

use App\Domain\UseCases\Author\UpdateAuthor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UpdateAuthorController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    public function __construct(
        private readonly UpdateAuthor $updateAuthor
    )
    {
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $this->validate($request, $this->rules());

            $result = $this->updateAuthor
                ->setArgs([
                    'id' => $request->route('id'),
                    'name' => $request->input('name'),
                    'surname' => $request->input('surname'),
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.author.index')->with(
                    $this->getParams($request, [
                        'success' => $result->getMessage(),
                    ])
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