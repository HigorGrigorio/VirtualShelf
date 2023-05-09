<?php

namespace App\Http\Controllers\Country;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasValidator;
use App\Domain\UseCases\Country\ExportCountries;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ExportCountriesController extends Controller implements IController
{
    use HasValidator;

    public function __construct(
        readonly ExportCountries $exportCountries
    )
    {
        $this->middleware('auth');
    }


    protected function rules(): array
    {
        return [
            'format' => 'required|in:csv,xls,xlsx,pdf'
        ];
    }

    protected function messages(): array
    {
        return [
            'format.required' => 'The format field is required',
            'format.in' => 'The format field must be one of the following types: csv, xls, xlsx, pdf',
        ];
    }

    protected function attributes(Request $request): array
    {
        return [
            'columns' => [
                'id',
                'name',
                'code',
                'created_at',
                'updated_at'
            ],
            'format' => $request->route('format'),
            'view' => [
                'name' => 'exports.pdf',
                'title' => 'Countries',
                'attributes' => [
                    'Id',
                    'Name',
                    'Code',
                    'Created At',
                    'Updated At'
                ]
            ],
            'filename' => 'countries',
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $this->validator(['format' => $request->route('format')])
                ->validate();

            $result = $this->exportCountries
                ->setArgs($this->attributes($request))
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = $result->get();
            }
        } catch (Exception $e) {
            $return = back()->with(
                $e->getMessage()
            );
        }

        return $return;
    }
}
