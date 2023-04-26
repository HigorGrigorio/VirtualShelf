<?php

namespace App\Http\Controllers\Country;

use App\Core\Infra\IController;
use App\Domain\UseCases\Country\UpdateCountry;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateCountryController extends Controller implements IController
{

    public function __construct(
        private readonly UpdateCountry $updateCountry
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
                Rule::unique('countries')->ignore($id),
            ],
            'code' => [
                'required',
                'string',
                'max:3',
                Rule::unique('countries')->ignore($id),
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $this->validate($request, $this->rules($request->route('id')));

            $result = $this->updateCountry
                ->setArgs([
                    'id' => $request->route('id'),
                    'name' => $request->input('name'),
                    'code' => $request->input('code'),
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.country.index')->with(
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
