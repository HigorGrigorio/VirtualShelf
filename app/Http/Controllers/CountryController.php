<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\CreateCountry;
use App\Domain\UseCases\LoadCountries;
use App\Domain\UseCases\LoadCountryById;
use App\Domain\UseCases\UpdateCountry;
use App\Http\Requests\CountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use \Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Routing\Redirector;

class CountryController extends Controller
{
    public function __construct(
        private readonly CreateCountry   $createCountry,
        private readonly LoadCountries   $loadCountries,
        private readonly LoadCountryById $loadCountry,
        private readonly UpdateCountry   $updateCountry,
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

            return view('pages.country.index');
        }

        $array = $result->get();

        if (count($array) == 0) {
            $this->info('No countries found');
        } else {
            $this->success($result->getMessage());
        }
        return view('pages.country.index')->with([
            'collection' => $result->get(),
        ]);
    }

    public function create(): Application|Factory|View|LaravelApplication
    {
        return view('pages.country.store');
    }

    public function store(CountryRequest $request): Application|LaravelApplication|RedirectResponse|Redirector
    {
        $raw = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ];

        $result = $this->createCountry
            ->execute($raw);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect('pages.country.store');
        }

        $this->success($result->getMessage());

        return redirect('/countries')->with([
            'success' => $result->getMessage(),
        ]);
    }

    public function edit(int $id): Application|Factory|View|LaravelApplication
    {
        $result  = $this->loadCountry->execute(['id' => $id]);


        if($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect('/countries');
        }

        $country = $result->get();

        return view('pages.country.edit')->with([
            'model' => $country,
        ]);
    }

    public function update(UpdateCountryRequest $request, int $id) {
        $raw = [
            'id' => $id,
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ];

        $result = $this->updateCountry
            ->execute($raw);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect('pages.country.edit');
        }

        $this->success($result->getMessage());

        return redirect('/countries')->with([
            'success' => $result->getMessage(),
        ]);
    }
}
