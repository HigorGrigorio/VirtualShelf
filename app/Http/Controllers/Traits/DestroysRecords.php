<?php

namespace App\Http\Controllers\Traits;

use App\Core\Logic\Result;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait DestroysRecords
{
    /**
     * @throws Exception
     */
    public function destroyImpl(Request $request, $id): RedirectResponse
    {
        $this->setRequest($request);
        $useCase = $this->getUseCase('destroy');

        try {
            $result = $useCase->execute([
                'id' => $id,
            ]);

            if ($result->isRejected()) {
                throw new Exception($result->getMessage());
            }

            $this->success($result);
            $response = $this->redirect('index', $this->getParams());
        } catch (Exception $e) {
            $this->danger(Result::from($e));
            $response = $this->redirect('index', $this->getParams());
        }

        return $response;
    }
}
