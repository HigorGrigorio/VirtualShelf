<?php

namespace App\Http\Controllers;

use App\Core\Logic\Result;
use App\Domain\UseCases\Country\CreateCountry;
use App\Domain\UseCases\Country\DeleteCountryById;
use App\Domain\UseCases\Country\LoadCountries;
use App\Domain\UseCases\Country\LoadCountryById;
use App\Domain\UseCases\Country\UpdateCountry;
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
    public string $table = 'countries';

    public function __construct(
        private readonly CreateCountry     $createCountry,
        private readonly LoadCountries     $loadCountries,
        private readonly LoadCountryById   $loadCountry,
        private readonly UpdateCountry     $updateCountry,
        private readonly DeleteCountryById $deleteCountry,
    )
    {
    }

    public function index(Request $request): View|RedirectResponse
    {
        try {
            $this->setRequest($request);
            $this->setResult($this->loadCountries->execute($this->getPaginationParams()));
            $view = $this->makeView('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function create(): Application|Factory|View|LaravelApplication
    {
        return $this->makeView('store');
    }

    public function store(StoreCountryRequest $request): Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try {
            $args = [
                'name' => $request->input('name'),
                'code' => $request->input('code'),
            ];
            $this->setRequest($request);
            $result = $this->createCountry->execute($args);
            $this->setResult($result);
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }

    public function edit(Request $request): Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try {
            $args = [
                'id' => $request->route('id'),
            ];
            $this->setRequest($request);
            $this->setResult($this->loadCountry->execute($args));
            $this->setResult($this->loadCountry->execute($args));
            $view = $this->makeView('edit');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function show(Request $request): View|RedirectResponse
    {
        try {
            $args = [
                'id' => $request->route('id'),
            ];
            $this->setRequest($request);
            $this->setResult($this->loadCountry->execute($args));
            $view = $this->makeView('show');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function update(UpdateCountryRequest $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        try{
            $args = [
                'id' => $request->route('id') ,
                'name' => $request->input('name'),
                'code' => $request->input('code'),
            ];
            $this->setRequest($request);
            $this->setResult($this->updateCountry->execute($args));
            $redirect = $this->redirect('index');
        }  catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }

    public function destroy(Request $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        try {
            $id = $request->route('id');
            $this->setRequest($request);
            $this->setResult($this->deleteCountry->execute(['id' => $id]));
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }
}
