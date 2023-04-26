<?php

namespace App\Http\Controllers\Country;

use App\Core\Infra\IController;
use App\Domain\UseCases\Category\LoadCategoryById;
use App\Domain\UseCases\Country\LoadCountryById;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class ShowEditCountryFormController extends Controller implements IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly LoadCountryById $loadCountryById
    )
    {
    }

    public function getTable(): string
    {
        return 'countries';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $findResult = $this->loadCountryById
                ->setArgs([
                    'id' => $request->route('id'),
                ])
                ->execute();

            if ($findResult->isRejected()) {
                abort(404);
            }

            $return = view('country.edit')->with(
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
