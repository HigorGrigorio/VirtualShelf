<?php

namespace App\Domain\UseCases\Base;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Presentation\Interfaces\IRepository;
use Throwable;

class CreateRecord implements IUseCase
{
    public function __construct(
        private readonly IRepository $repository
    )
    {
    }

    public function execute($data): Result
    {
        try {
            $id = $this->repository->create($data);
            $result = Result::accept(Maybe::flat($id), 'Resource created successfully');
        } catch (Throwable $e) {
            $result = Result::from($e);
        }

        return $result;
    }

    public static function create(IRepository $repository): CreateRecord
    {
        return new CreateRecord($repository);
    }
}