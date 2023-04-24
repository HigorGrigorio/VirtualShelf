<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;

class UpdateAuthorController extends \App\Http\Controllers\Controller implements \App\Core\Infra\IController
{
    public function __construct(
        private readonly \App\Domain\UseCases\Author\UpdateAuthor $updateAuthor
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            $result = $this->updateAuthor
                ->setArgs([
                    'id' => $request->route('id'),
                    'name' => $request->input('name'),
                    'surname' => $request->input('surname'),
                ])
                ->execute();

            if ($result->isRejected()) {
                $return = back()->with([
                    'danger' => $result->getMessage()
                ]);
            } else {
                $return = redirect()->route('tables.author.index')->with(
                    $this->getParams($request, [
                        'success' => $result->getMessage(),
                    ])
                );
            }
        } catch (\Exception) {
            $return = back()->with([
                'danger' => 'Do not possible to update this record',
            ]);
        }
        return $return;
    }
}
