<?php

namespace App\Http\Controllers\Traits;

use App\Core\Logic\Result;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait LoadsRecords
{
    /**
     * @throws Exception
     */
    public function indexImpl(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {

        $this->setRequest($request);
        $useCase = $this->getUseCase('index');

        try {
            $args = $this->getPaginationParams();

            $result = $useCase->execute($args);

            if ($result->isRejected()) {
                throw new Exception($result->getMessage());
            }

            $response = $this->makeView('index', [
                'pagination' => $result->get(),
                'columns' => $this->getColumns(),
            ]);
        } catch (Exception $e) {
            $this->danger(Result::from($e));
            $response = redirect()->back();
        }
        return $response;
    }
}
