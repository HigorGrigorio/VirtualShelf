<?php

namespace App\Http\Controllers\Author;

use App\Domain\UseCases\Author\DeleteAuthorById;
use Exception;
use http\Exception\RuntimeException;
use Illuminate\Http\Request;

class DeleteAuthorController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    public function __construct(
        private readonly DeleteAuthorById $deleteAuthorById
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
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
