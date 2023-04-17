<?php

namespace App\Http\Controllers;

use App\Core\Logic\Result;
use App\Domain\UseCases\Language\CreateLanguage;
use App\Domain\UseCases\Language\DeleteLanguageById;
use App\Domain\UseCases\Language\LoadLanguageById;
use App\Domain\UseCases\Language\LoadLanguages;
use App\Domain\UseCases\Language\UpdateLanguage;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class LanguageController extends Controller
{
    public string $table = 'languages';

    public function __construct(
        private readonly LoadLanguages      $loadLanguages,
        private readonly CreateLanguage     $createLanguage,
        private readonly UpdateLanguage     $updateLanguage,
        private readonly LoadLanguageById   $loadLanguage,
        private readonly DeleteLanguageById $deleteLanguage,
    )
    {
    }

    public function index(Request $request): View|RedirectResponse
    {
        try {
            $this->setRequest($request);
            $this->setResult($this->loadLanguages->execute($this->getPaginationParams()));
            $view = $this->makeView('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function create(): View|LaravelApplication|Factory|Application
    {
        return $this->makeView('store');
    }

    public function store(StoreLanguageRequest $request): RedirectResponse
    {
        try {
            $args = [
                'name' => $request->input('name'),
                'acronym' => $request->input('slug'),
            ];
            $this->setRequest($request);
            $result = $this->createLanguage->execute($args);
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
            $this->setResult($this->loadLanguage->execute($args));
            $this->setResult($this->loadLanguage->execute($args));
            $view = $this->makeView('edit');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function show(Request $request): Application|Factory|View|LaravelApplication|RedirectResponse
    {
        try {
            $args = [
                'id' => $request->route('id'),
            ];
            $this->setRequest($request);
            $this->setResult($this->loadLanguage->execute($args));
            $view = $this->makeView('show');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $view = $this->redirect('back');
        }
        return $view;
    }

    public function update(UpdateLanguageRequest $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        try {
            $args = [
                'id' => $request->route('id'),
                'name' => $request->input('name'),
                'acronym' => $request->input('acronym'),
            ];
            $this->setRequest($request);
            $this->setResult($this->updateLanguage->execute($args));
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
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
            $this->setResult($this->deleteLanguage->execute(['id' => $id]));
            $redirect = $this->redirect('index');
        } catch (Exception $e) {
            $this->setResult(Result::from($e));
            $redirect = $this->redirect('back');
        }
        return $redirect;
    }
}
