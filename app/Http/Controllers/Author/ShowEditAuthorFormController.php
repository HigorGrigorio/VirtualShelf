<?php

namespace App\Http\Controllers\Author;

use App\Core\Infra\IController;
use App\Domain\UseCases\Author\LoadAuthorById;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowEditAuthorFormController extends Controller implements IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly LoadAuthorById $loadUserById
    )
    {
    }

    public function getTable(): string
    {
        return 'authors';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $findResult = $this->loadUserById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            $return = view('author.edit')->with(
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
