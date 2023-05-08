<?php

namespace App\Http\Controllers\Language;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Language\CreateLanguage;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreLanguageController extends Controller implements IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly CreateLanguage $createLanguage
    )
    {
    }

    protected function getTable(): string
    {
        return 'languages';
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:languages',
            'acronym' => 'required|string|max:3|unique:languages'
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $this->validate($request, $this->rules());

            $result = $this->createLanguage
                ->setArgs([
                    'name' => $request->input('name'),
                    'acronym' => $request->input('acronym'),
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.language.index')->with([
                    'success' => $result->getMessage()
                ]);
            }
        } catch (ValidationException $e) {
            $return = back()->withErrors(
                $e->errors()
            );
        } catch (Exception $e) {
            $return = back()->with([
                'danger' => $e->getMessage()
            ]);
        }

        return $return;
    }
}
