<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Language\CreateLanguage;
use App\Domain\UseCases\Language\DeleteLanguageById;
use App\Domain\UseCases\Language\LoadLanguageById;
use App\Domain\UseCases\Language\LoadLanguages;
use App\Domain\UseCases\Language\UpdateLanguage;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    public function __construct(
        private readonly LoadLanguages      $loadLanguages,
        private readonly CreateLanguage     $createLanguage,
        private readonly UpdateLanguage     $updateLanguage,
        private readonly LoadLanguageById   $loadLanguage,
        private readonly DeleteLanguageById $deleteLanguage,
    )
    {
    }

    public function index(Request $request): View|LaravelApplication|Factory|Application
    {
        $options = [
            'page' => $request->page ?? 1,
            'limit' => $request->limit ?? 10,
            'search' => $request->search ?? ''
        ];

        $result = $this->loadLanguages->execute($options);

        $view = view('pages.language.index');

        if ($result->isRejected()) {
            $this->danger($result->getMessage(), 'Internal Server Error');
        } else {
            $view->with([
                'pagination' => $result->get(),
            ]);
        }

        $view->with([
            'search' => $options['search'] ?? '',
            'limit' => $options['limit'] ?? Config::get('app.pagination.per_page'),
            'limits' => Config::get('app.pagination.limits'),
        ]);

        return $view;
    }

    public function create(): View|LaravelApplication|Factory|Application
    {
        return view('pages.language.store');
    }

    public function store(LanguageRequest $request): RedirectResponse
    {
        $options = [
            'name' => $request->name,
            'acronym' => $request->acronym,
        ];

        $result = $this->createLanguage->execute($options);

        if ($result->isRejected()) {
            $this->danger($result->getMessage(), 'Internal Server Error');
            return redirect()->back()->withInput();
        }

        $this->success($result->getMessage(), 'Success');
        return redirect()->route('tables.language.index');
    }

    public function edit($id): View|LaravelApplication|Factory|Application
    {
        $result = $this->loadLanguage->execute(['id' => $id]);


        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect('table/languages');
        }

        $language = $result->get();

        return view('pages.language.edit')->with([
            'model' => $language,
        ]);
    }

    public function update($id, UpdateLanguageRequest $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        $raw = [
            'id' => $id,
            'name' => $request->input('name'),
            'acronym' => $request->input('acronym'),
        ];

        $result = $this->updateLanguage
            ->execute($raw);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect()->back();
        }

        $this->success($result->getMessage());

        return redirect()->route('tables.language.index');
    }

    public function destroy(int $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        $result = $this->deleteLanguage->execute(['id' => $id]);

        if ($result->isRejected()) {
            $this->danger($result->getMessage());
            return redirect()->back();
        }

        $this->success($result->getMessage());

        return redirect()->route('tables.language.index');
    }
}
