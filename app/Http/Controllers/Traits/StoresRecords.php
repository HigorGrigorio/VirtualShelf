<?php

namespace App\Http\Controllers\Traits;

use App\Core\Domain\IUseCase;
use App\Core\Infra\IController;
use App\Core\Logic\Result;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class StoresRecord
 *
 * @package App\Http\Controllers
 * @template TRequest
 * @template TResponse
 *
 * @implements IController<TRequest,TResponse>
 */
trait StoresRecords
{

    /**
     * @throws Exception
     */
    protected function createImpl(Request $request): View|RedirectResponse
    {
        $this->setRequest($request);

        try {
            $return = $this->makeView(
                'store',
                $this->getHelps('store')
            );
        } catch (Exception $e) {
            $this->danger(Result::from($e));
            $return = $this->redirect('index',
                $this->getParams()
            );
        }

        return $return;
    }

    /**
     * Use this implementation to handle a custom form request.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    protected function storeImpl(Request $request): RedirectResponse
    {
        $this->setRequest($request);

        $useCase = $this->getUseCase('store');

        try {
            $args = $request->all();
            $result = $useCase->execute($args);

            if ($result->isRejected()) {
                throw new Exception($result->getMessage());
            }

            $this->success($result);
        } catch (Exception $e) {
            $this->danger(Result::from($e));
        }

        return $this->redirect('index', $this->getParams());
    }
}
