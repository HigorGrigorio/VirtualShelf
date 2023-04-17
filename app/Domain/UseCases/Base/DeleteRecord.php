<?php

namespace App\Domain\UseCases\Base;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\IRepository;
use Exception;
use Throwable;

class DeleteRecord implements IUseCase
{
    public function __construct(
        private readonly IRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            if(!isset($data['id'])) {
                throw new Exception('Id is required');
            }

            $id = $data['id'];
            if ($this->repository->delete(['id' => $id]) === 0)
                $result = Result::reject(
                    Maybe::nothing(),
                    'Record not found'
                );
            else
                $result = Result::accept(
                    Maybe::just(1),
                    'Record deleted successfully'
                );
        } catch (Throwable $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
