<?php

namespace App\Http\Controllers\Country;

use App\Core\Infra\IController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowStoreCountryFormController extends Controller implements IController
{
    use HasRecordArguments;

    protected function getTable(): string
    {
        return 'countries';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            return view('country.store', $this->getParams(
                $request,
                $this->getRecordArgs()
            ));
        } catch (Exception $e) {
            abort(404);
        }
    }
}
