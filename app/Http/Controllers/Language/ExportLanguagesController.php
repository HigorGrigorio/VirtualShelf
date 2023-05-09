<?php

namespace App\Http\Controllers\Language;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasValidator;
use App\Domain\UseCases\Language\ExportLanguages;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ExportLanguagesController extends Controller implements IController
{
    use HasValidator;

    public function __construct(
        readonly ExportLanguages $exportLanguages
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
                'acronym',
                'name',
                'created_at',
                'updated_at'
            ],
            'format' => $request->route('format'),
            'view' => [
                'name' => 'exports.pdf',
                'title' => 'Languages',
                'attributes' => [
                    'Id',
                    'Acronym',
                    'Name',
                    'Created At',
                    'Updated At'
                ]
            ],
            'filename' => 'languages',
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

            $result = $this->exportLanguages
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
