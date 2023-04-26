<?php

namespace App\Http\Controllers\User;

use App\Domain\UseCases\User\LoadUserById;
use App\Http\Controllers\HasRecordArguments;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Exception;

class ShowUserController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly LoadUserById $loadUserById
    )
    {
    }

    // for record arguments
    public function getTable(): string
    {
        return 'users';
    }

    /**
     * @inheritDoc
     */
    public
    function handle(Request $request)
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

            return view('user.show', $this->getParams(
                $request,
                [
                    'record' => $findResult->get(),
                ])
            );
        } catch (Exception) {
            return back()->with([
                'danger' => "Don't is possible show this user"
            ]);
        }
    }
}
