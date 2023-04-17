<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Country\CreateCountry;
use App\Domain\UseCases\Country\DeleteCountryById;
use App\Domain\UseCases\Country\LoadCountries;
use App\Domain\UseCases\Country\LoadCountryById;
use App\Domain\UseCases\Country\UpdateCountry;
use App\Http\Controllers\Traits\DestroysRecords;
use App\Http\Controllers\Traits\EditsRecords;
use App\Http\Controllers\Traits\HandlesRecords;
use App\Http\Controllers\Traits\LoadsRecords;
use App\Http\Controllers\Traits\StoresRecords;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CountryController extends Controller
{
    use LoadsRecords, StoresRecords, EditsRecords, DestroysRecords, HandlesRecords;

    public string $table = 'countries';

    /**
     * The columns that will be displayed in the table.
     *
     * @var array $columns
     */
    public array $columns = [
        'id' => '#',
        'icon' => [
            'label' => 'Icon',
            'type' => 'html',
            'bind' => ['icon'],
            'value' => '<img src="${icon}" alt="icon" style="width: 35px; object-fit: cover;">',
        ],
        'name' => 'Name',
        'code' => 'Code',
        'actions' => [
            'label' => 'Actions',
            'edit' => [
                'route' => 'tables.country.edit',
                'params' => ['id' => 'id']
            ],
            'delete' => [
                'route' => 'tables.country.destroy',
                'params' => ['id' => 'id']
            ]
        ]
    ];

    /**
     * Helps for fillable fields.
     *
     * @var array $helps
     */
    public array $helps = [
        'name' => 'Make sure the country is not registered',
        'acronym' => 'The acronym country must be 2 characters long in accordance with ISO 3166-1:2002',
        'edit' => [
            'name' => 'if modified, make sure the country is not registered',
        ],
    ];

    public function __construct(
        private readonly CreateCountry     $createCountry,
        private readonly LoadCountries     $loadCountries,
        private readonly LoadCountryById   $loadCountry,
        private readonly UpdateCountry     $updateCountry,
        private readonly DeleteCountryById $deleteCountry,
    )
    {
        $this->setUseCases([
            'index' => $this->loadCountries,
            'store' => $this->createCountry,
            'update' => $this->updateCountry,
            'load' => $this->loadCountry,
            'destroy' => $this->deleteCountry,
        ]);
    }

    /**
     * @throws Exception
     */
    public function index(Request $request): LaravelApplication|Factory|View|RedirectResponse|Application
    {
        return $this->indexImpl($request);
    }

    /**
     * @throws Exception
     */
    public function create(Request $request): Factory|View|Application
    {
        return $this->createImpl($request);
    }

    /**
     * @throws Exception
     */
    public function edit(Request $request, $id): Factory|View|Application
    {
        return $this->editImpl($request, $id);
    }

    /**
     * @throws Exception
     */
    public function destroy(Request $request, int $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        return $this->destroyImpl($request, $id);
    }

    /**
     * @throws Exception
     */
    public function store(StoreCountryRequest $request): RedirectResponse|Factory|View|Application|LaravelApplication
    {
        return $this->storeImpl($request);
    }

    /**
     * @throws Exception
     */
    public function update(UpdateCountryRequest $request, $id): RedirectResponse|Factory|View|Application|LaravelApplication
    {
        return $this->updateImpl($request, $id);
    }
}
