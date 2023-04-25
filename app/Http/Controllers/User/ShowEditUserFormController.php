<?php

namespace App\Http\Controllers\User;

use App\Core\Infra\IController;
use App\Domain\UseCases\User\LoadUserById;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowEditUserFormController extends Controller implements IController
{
    use HasRecordArguments;

    public function __construct(
        public readonly LoadUserById $loadUserById
    )
    {
    }

    public function getTable(): string
    {
        return 'users';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $findResult = $this->loadUserById
                ->setArgs([
                    'id' => $request->route('id')
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            $return = view('user.edit')->with(
                $this->getParams($request,
                    [
                        'record' => $findResult->get(),
                    ],
                    $this->getRecordArgs()
                )
            );
        } catch (Exception) {
            $return = back()->with(
                $this->getParams($request, [
                    'danger' => 'Do not possible to edit this record',
                ])
            );
        }
        return $return;
    }
}
