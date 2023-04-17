<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Language\CreateLanguage;
use App\Domain\UseCases\Language\DeleteLanguageById;
use App\Domain\UseCases\Language\LoadLanguageById;
use App\Domain\UseCases\Language\LoadLanguages;
use App\Domain\UseCases\Language\UpdateLanguage;
use App\Http\Controllers\Traits\DestroysRecords;
use App\Http\Controllers\Traits\EditsRecords;
use App\Http\Controllers\Traits\HandlesRecords;
use App\Http\Controllers\Traits\LoadsRecords;
use App\Http\Controllers\Traits\StoresRecords;
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
    use LoadsRecords, StoresRecords, EditsRecords, DestroysRecords, HandlesRecords;

    public string $table = 'languages';

    /**
     * Helps for fillable fields.
     *
     * @var array $helps
     */
    public array $helps = [
        'name' => 'Make sure the language is not registered',
        'acronym' => 'The acronym language must be 2 characters long in accordance with ISO 639-1:2002',
        'edit' => [
            'name' => 'If modified, make sure the language is not registered',
        ],
    ];

    /**
     * The columns that will be displayed in the table.
     *
     * @var array $columns
     */
    public array $columns = [
        'id' => '#',
        'name' => 'Name',
        'acronym' => 'Acronym',
        'actions' => [
            'label' => 'Actions',
            'edit' => [
                'route' => 'tables.language.edit',
                'params' => ['id' => 'id']
            ],
            'delete' => [
                'route' => 'tables.language.destroy',
                'params' => ['id' => 'id']
            ]
        ],
    ];

    public function __construct(
        private readonly LoadLanguages      $loadLanguages,
        private readonly CreateLanguage     $createLanguage,
        private readonly UpdateLanguage     $updateLanguage,
        private readonly LoadLanguageById   $loadLanguage,
        private readonly DeleteLanguageById $deleteLanguage,
    )
    {
        $this->setUseCases([
            'index' => $this->loadLanguages,
            'store' => $this->createLanguage,
            'update' => $this->updateLanguage,
            'load' => $this->loadLanguage,
            'destroy' => $this->deleteLanguage,
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
    public function store(StoreLanguageRequest $request): LaravelApplication|Redirector|RedirectResponse|Application
    {
        return $this->storeImpl($request);
    }


    /**
     * @throws Exception
     */
    public function update(UpdateLanguageRequest $request, $id): LaravelApplication|Redirector|RedirectResponse|Application
    {
        return $this->updateImpl($request, $id);
    }
}
