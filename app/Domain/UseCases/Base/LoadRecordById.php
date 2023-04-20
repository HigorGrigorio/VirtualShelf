<?php

namespace App\Domain\UseCases\Base;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Presentation\Interfaces\IRepository;
use Exception;

class LoadRecordById implements IUseCase
{
    public function __construct(
        private readonly IRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            if (!isset($data['id'])) {
                throw new Exception('Id is required');
            }

            $id = $data['id'];

            $maybe = $this->repository->getById($id);

            if ($maybe->isNothing())
                $result = Result::reject(Maybe::nothing(), "Record with '$id' not found");
            else
                $result = Result::accept($maybe, 'Record loaded successfully');
        } catch (Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
