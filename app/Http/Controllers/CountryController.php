<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\CreateCountry;
use App\Domain\UseCases\LoadCountries;
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
        private readonly CreateCountry $createCountry,
        private readonly LoadCountries $loadCountries
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

        return view('pages.country.index')->with($result->toArray(['value' => 'collection']));
    }

    public function create(): Application|Factory|View|LaravelApplication
    {
        return view('pages.country.store');
    }

    public function store(Request $request): Application|LaravelApplication|RedirectResponse|Redirector
    {
        $raw = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ];

        $result = $this->createCountry
            ->execute($raw);

        if($result->isRejected()) {
            return redirect('pages.country.store')->with([
                'fail' => $result->getMessage(),
            ]);
        }

        return redirect('/countries')->with([
            'success' => $result->getMessage(),
        ]);
    }
}
