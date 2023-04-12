<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Country\CreateCountry;
use App\Domain\UseCases\Country\DeleteCountryById;
use App\Domain\UseCases\Country\LoadCountries;
use App\Domain\UseCases\Country\LoadCountryById;
use App\Domain\UseCases\Country\UpdateCountry;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CountryController extends Controller
{
    public function __construct(
        private readonly CreateCountry     $createCountry,
        private readonly LoadCountries     $loadCountries,
        private readonly LoadCountryById   $loadCountry,
        private readonly UpdateCountry     $updateCountry,
        private readonly DeleteCountryById $deleteCountry,
    )
    {
    }

    public function index(Request $request): Application|Factory|View|LaravelApplication|JsonResponse
    {
        $options = [
            'page' => $request->page ?? 1,
            'limit' => $request->limit ?? 10,
            'search' => $request->search ?? ''
        ];

        $result = $this->loadCountries
            ->execute($options);

        if ($result->isRejected()) {
            $this->danger($result->getMessage(), 'Internal Server Error');

            $view = view('pages.country.index');
        } else {
            if ($result->get()->count() == 0) {
                $this->info('No countries found');
            }
            $view = view('pages.country.index')->with([
                'pagination' => $result->get(),
            ]);
        }

        $view->with([
            'search' => $options['search'],
            'limit' => $options['limit'],
            'limits' => [10, 25, 50, 100],
        ]);

        return $view;
    }

    public function create(): Application|Factory|View|LaravelApplication
    {
        return view('pages.country.store');
    }

    public function store(StoreCountryRequest $request): Application|LaravelApplication|RedirectResponse|Redirector
    {
        $raw = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ];

        $result = $this->createCountry
            ->execute($raw);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect('tables.country.store');
        }

        $this->success($result->getMessage());

        return redirect()->route('pages.countries.index');
    }

    public function edit(int $id): RedirectResponse|Application|Factory|View|LaravelApplication
    {
        $result = $this->loadCountry->execute(['id' => $id]);


        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect()->back();
        }

        $country = $result->get();

        return view('pages.country.edit')->with([
            'model' => $country,
        ]);
    }

    public function update(int $id, UpdateCountryRequest $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        $raw = [
            'id' => $id,
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ];

        $result = $this->updateCountry
            ->execute($raw);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect()->back();
        }

        $this->success($result->getMessage());

        return redirect()->route('tables.country.index');
    }

    public function destroy(int $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        $result = $this->deleteCountry->execute(['id' => $id]);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect()->back();
        }

        $this->success($result->getMessage());

        return redirect()->route('tables.country.index');
    }
}
