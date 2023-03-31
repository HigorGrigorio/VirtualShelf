<?php

namespace App\Http\Controllers;

use App\Core\Logic\ResultStatus;
use App\Domain\UseCases\CreateCountry;
use App\Domain\UseCases\LoadCountries;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Foundation\Application as LaravelApplication;

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
}
