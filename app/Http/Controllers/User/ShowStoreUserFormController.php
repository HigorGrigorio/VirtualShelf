<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowStoreUserFormController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    use HasRecordArguments;

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
            return view('user.store', $this->getParams(
                $request,
                $this->getRecordArgs()
            ));
        } catch (Exception $e) {
            abort(404);
        }
    }
}
