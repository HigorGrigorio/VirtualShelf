<?php

namespace App\Http\Controllers\User;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasValidator;
use App\Domain\UseCases\User\ExportUsers;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ExportUsersController extends Controller implements IController
{
    use HasValidator;

    public function __construct(
        readonly ExportUsers $exportUsers
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
                'email',
                'name',
                'created_at',
                'updated_at'
            ],
            'format' => $request->route('format'),
            'view' => [
                'name' => 'exports.pdf',
                'title' => 'Users',
                'attributes' => [
                    'Id',
                    'Email',
                    'Name',
                    'Created At',
                    'Updated At'
                ]
            ],
            'filename' => 'users',
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

            $result = $this->exportUsers
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
