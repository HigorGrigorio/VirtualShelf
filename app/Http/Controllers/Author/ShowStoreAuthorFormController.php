<?php

namespace App\Http\Controllers\Author;

use App\Core\Infra\IController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowStoreAuthorFormController extends Controller implements IController
{
    use HasRecordArguments;

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
            $return = view('author.store')->with(
                $this->getRecordArgs(),
            );
        } catch (Exception) {
            abort(404);
        }
        return $return;
    }
}
