<?php

namespace App\Http\Controllers\Country;

use App\Domain\UseCases\Country\LoadCountries;
use App\Http\Controllers\HasPaginationArguments;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class LoadCountriesController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    use HasRecordArguments, HasPaginationArguments;

    public function __construct(
        private readonly LoadCountries $loadCountries
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
            $args = $this->getArgsOfPagination($request);
            $result = $this->loadCountries
                ->setArgs($args)
                ->execute();

            if ($result->isRejected()) {
                $return = back()->withErrors([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $pagination = $result->get();
                $return = view('country.index', compact('pagination'))->with(
                    $this->getParams(
                        $request,
                        $this->getRecordArgs(),
                        $args
                    ),
                );
            }
        } catch (Exception $e) {
            $return = back()->with([
                'danger' => $e->getMessage()
            ]);
        }
        return $return;
    }
}
