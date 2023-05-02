<?php

namespace App\Http\Controllers\Author;

use App\Core\Infra\IController;
use App\Domain\UseCases\Author\DeleteAuthorById;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteAuthorController extends Controller implements IController
{
    public function __construct(
        private readonly DeleteAuthorById $deleteAuthorById
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        try {
            $deleteResult = $this->deleteAuthorById
                ->setArgs([
                    'id' => $request->route('id')
                ])
                ->execute();

            if($deleteResult->isRejected()) {
                throw new Exception($deleteResult->getMessage());
            }

            $result = redirect()->route('tables.author.index')->with([
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
