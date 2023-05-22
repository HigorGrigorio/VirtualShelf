<?php

namespace App\Domain\UseCases\Base;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\UseCase;
use App\Http\Database\Contracts\GetAllRepository;
use App\Http\Database\Contracts\Repository;
use Exception;

class LoadRecords extends UseCase
{
    public function __construct(
        GetAllRepository $repository
    )
    {
        parent::__construct($repository);
    }

    public function execute(): Result
    {
        try {
            $loadResult = $this->getRepository()->getAll();
            $result = Result::accept(
                Maybe::just($loadResult),
                'Record loaded successfully'
            );
        } catch (Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
