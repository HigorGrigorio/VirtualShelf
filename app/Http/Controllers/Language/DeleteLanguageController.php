<?php

namespace App\Http\Controllers\Language;

use App\Core\Infra\IController;
use App\Domain\UseCases\Language\DeleteLanguageById;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteLanguageController extends Controller implements IController
{

    public function __construct(
        private readonly DeleteLanguageById $deleteLanguageById
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $deleteResult = $this->deleteLanguageById
                ->setArgs([
                    'id' => $request->route('id')
                ])
                ->execute();

            if ($deleteResult->isRejected()) {
                throw new Exception($deleteResult->getMessage());
            }

            $result = redirect()->route('tables.language.index')->with([
                'success' => $deleteResult->getMessage()
            ]);
        } catch (Exception $e) {
            $result = back()->with([
                'danger' => $e->getMessage()
            ]);
        }
        return $result;
    }
}
