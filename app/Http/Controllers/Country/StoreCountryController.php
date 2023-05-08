<?php

namespace App\Http\Controllers\Country;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Country\CreateCountry;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreCountryController extends Controller implements IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly CreateCountry $createCountry
    )
    {
    }

    protected function getTable(): string
    {
        return 'countries';
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:countries',
            'code' => 'required|string|max:3|unique:countries'
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $this->validate($request, $this->rules());

            $result = $this->createCountry
                ->setArgs([
                    'name' => $request->input('name'),
                    'code' => $request->input('code'),
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.country.index')->with([
                    'success' => $result->getMessage()
                ]);
            }
        } catch (ValidationException $e) {
            $return = back()->withErrors(
                $e->errors()
            );
        } catch (Exception $e) {
            $return = back()->with([
                'danger' => $e->getMessage()
            ]);
        }

        return $return;
    }
}
