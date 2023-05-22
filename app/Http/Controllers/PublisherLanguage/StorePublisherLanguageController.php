<?php

namespace App\Http\Controllers\PublisherLanguage;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\PublisherLanguage\CreatePublisherLanguage;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StorePublisherLanguageController extends Controller implements IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly CreatePublisherLanguage $addPublisherToLanguage,
    )
    {
    }

    protected function getTable(): string
    {
        return 'publishers_languages';
    }

    protected function rules(): array
    {
        return [
            'publisher_id' => 'required|exists:publishers,id',
            'language_id' => 'required|exists:languages,id',
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $args = $this->validate($request, $this->rules());

            $result = $this->addPublisherToLanguage
                ->setArgs($args)
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.publishers-language.index')->with([
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
