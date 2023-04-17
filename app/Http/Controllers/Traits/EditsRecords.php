<?php

namespace App\Http\Controllers\Traits;

use App\Core\Logic\Result;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait EditsRecords
{
    /**
     * @throws Exception
     */
    public function getEditingOptions(): array
    {
        $options = [];

        if (isset($this->helps))
            $options['helps'] = $this->getHelps('edit');

        $options['fillables'] = $this->getShowables();

        return $options;
    }

    /**
     * @throws Exception
     */
    public function editImpl(Request $request, $id): View|RedirectResponse
    {
        $useCase = $this->getUseCase('load');

        $this->setRequest($request);

        try {
            $result = $useCase->execute(compact('id'));

            if ($result->isRejected()) {
                throw new Exception($result->getMessage());
            }

            $return = $this->makeView('edit', [
                'model' => $result->get(),
            ], $this->getEditingOptions());
        } catch (Exception $e) {
            $this->danger(Result::from($e));
            $return = $this->redirect(
                'index',
                $this->getPaginationParams(),
            );
        }

        return $return;
    }

    /**
     * Use this method to handle a custom form request.
     *
     * @throws Exception
     */
    public function updateImpl(Request $request, int $id): RedirectResponse
    {
        $context = 'update';
        $useCase = $this->getUseCase($context);

        try {
            $args = $request->all();
            $args['id'] = $id;

            $result = $useCase->execute($args);

            if ($result->isRejected()) {
                throw new Exception($result->getMessage());
            }

            $this->success($result);
        } catch (Exception $e) {
            $this->danger(Result::from($e));
        }

        return $this->redirect('index');
    }
}
