<?php

namespace App\Http\Controllers\Country;

use App\Core\Infra\IController;
use App\Domain\UseCases\Country\DeleteCountryById;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteCountryController extends Controller implements IController
{

    public function __construct(
        private readonly DeleteCountryById $deleteCountryById
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $deleteResult = $this->deleteCountryById
                ->setArgs([
                    'id' => $request->route('id')
                ])
                ->execute();

            if ($deleteResult->isRejected()) {
                throw new Exception($deleteResult->getMessage());
            }

            $result = redirect()->route('tables.country.index')->with([
                'success' => $deleteResult->getMessage()
            ]);
        } catch (Exception $e) {
            $result = back()->with([
                'danger' => $e->getMessage()
            ]);
        }
        return $result;
    }
}
