<?php

namespace App\Http\Controllers\PublisherLanguage;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\PublisherLanguage\UpdatePublisherLanguage;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UpdatePublisherLanguageController extends Controller implements IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly UpdatePublisherLanguage $updatePublisher
    )
    {
    }

    public function rules(): array
    {

        return [
            'publisher_id' => [
                'required',
                'exists:publishers,id',
            ],
            'language_id' => [
                'required',
                'exists:languages,id',
            ],
        ];
    }

    protected function getTable(): string
    {
        return 'publishers_languages';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $this->validate($request, $this->rules());

            $result = $this->updatePublisher
                ->setArgs([
                    'id' => $request->route('id'),
                    'language_id' => $request->input('language_id'),
                    'publisher_id' => $request->input('publisher_id'),
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.publishers-language.index')->with(array_merge(
                    $this->getRecordArgs(),
                    [
                        'success' => $result->getMessage(),
                    ]
                ));
            }
        } catch (ValidationException $e) {
            $return = back()->with([
                'danger' => 'Validation errors',
            ])->withErrors($e->errors());
        } catch (Exception $e) {
            $return = back()->with([
                'danger' => 'Do not possible to update this record',
            ]);
        }
        return $return;
    }
}
