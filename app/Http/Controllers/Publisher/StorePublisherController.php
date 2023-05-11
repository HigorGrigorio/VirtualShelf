<?php

namespace App\Http\Controllers\Publisher;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\HasRecordArguments;
use App\Domain\UseCases\Publisher\CreatePublisher;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StorePublisherController extends Controller implements IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly CreatePublisher $createPublisher
    )
    {
    }

    protected function getTable(): string
    {
        return 'publishers';
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:publishers',
            'email' => 'required|email|unique:publishers',
            'state_id' => 'required|integer|exists:states,id'
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $args = $this->validate($request, $this->rules());

            $result = $this->createPublisher
                ->setArgs($args)
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.publisher.index')->with([
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
