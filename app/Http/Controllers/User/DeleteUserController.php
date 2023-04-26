<?php

namespace App\Http\Controllers\User;

use App\Domain\UseCases\User\DeleteUserById;
use App\Http\Controllers\HasRecordArguments;
use Exception;
use Illuminate\Http\Request;

class DeleteUserController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    use HasRecordArguments;

    public function __construct(
        private readonly DeleteUserById $deleteUserById
    )
    {
    }

    protected function getTable(): string
    {
        return 'users';
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $deleteResult = $this->deleteUserById
                ->setArgs([
                    'id' => $request->route('id')
                ])
                ->execute();

            if ($deleteResult->isRejected()) {
                throw new Exception($deleteResult->getMessage());
            }

            $return = redirect()
                ->route('tables.author.index')
                ->with([
                    'success' => $deleteResult->getMessage()
                ]);
        } catch (Exception $e) {
            $return = back()->with([
                'danger' => $e->getMessage()
            ]);
        }
        return $return;
    }
}
