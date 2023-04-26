<?php

namespace App\Http\Controllers\Author;

use App\Core\Infra\IController;
use App\Domain\UseCases\Author\LoadAuthorById;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowAuthorController extends Controller implements IController
{
    use HasRecordArguments;

    public function __construct(
        public readonly LoadAuthorById $loadAuthorById
    )
    {
    }

    // for records arguments
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
            $findResult = $this->loadAuthorById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            $return = view('author.show')->with($this->getParams(
                $request,
                [
                    $this->getRecordArgs(),
                    [
                        'record' => $findResult->get()
                    ]
                ])
            );
        } catch (Exception) {
            $return = back()->with([
                'danger' => "Don't is possible show author"
            ]);
        }
        return $return;
    }
}
