<?php

namespace App\Http\Controllers\Publisher;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasValidator;
use App\Domain\UseCases\Publisher\ExportPublishers;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ExportPublishersController extends Controller implements IController
{
    use HasValidator;

    public function __construct(
        readonly ExportPublishers $exportPublishers
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
                'email',
                'state_id',
                'created_at',
                'updated_at'
            ],
            'format' => $request->route('format'),
            'view' => [
                'name' => 'exports.pdf',
                'title' => 'Publishers',
                'attributes' => [
                    'Id',
                    'Name',
                    'Email',
                    'State Id',
                    'Created At',
                    'Updated At'
                ],
            ],
            'filename' => 'publishers',
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

            $result = $this->exportPublishers
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
