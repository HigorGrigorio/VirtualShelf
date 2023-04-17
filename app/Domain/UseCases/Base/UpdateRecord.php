<?php

namespace App\Domain\UseCases\Base;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IRepository;
use Exception;

class UpdateRecord implements IUseCase
{
    public function __construct(
        private readonly IRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            if (!isset($data['id']))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Record id is required'
                );
            else {

                $id = $data['id'];
                unset($data['id']);

                if (!$this->repository->update($data, compact('id')))
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Record not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(
                            $this->repository->getById($id)
                        ),
                        'Record updated successfully'
                    );
            }

        } catch (Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
