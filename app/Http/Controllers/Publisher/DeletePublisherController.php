<?php

namespace App\Http\Controllers\Publisher;

use App\Core\Infra\IController;
use App\Domain\UseCases\Publisher\DeletePublisherById;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeletePublisherController extends Controller implements IController
{

    public function __construct(
        private readonly DeletePublisherById $deletePublisherById
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $deleteResult = $this->deletePublisherById
                ->setArgs([
                    'id' => $request->route('id')
                ])
                ->execute();

            if ($deleteResult->isRejected()) {
                throw new Exception($deleteResult->getMessage());
            }

            $result = redirect()->route('tables.publisher.index')->with([
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
