<?php

namespace App\Domain\UseCases\Base;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\UseCase;
use App\Presentation\Contracts\IRepository;
use Exception;

class LoadRecordById extends UseCase
{
    public function __construct(
       IRepository $repository
    )
    {
        parent::__construct($repository);
    }

    public function execute(): Result
    {
        try {
            if ($this->getArg('id') === null) {
                throw new Exception('Id is required');
            }

            $id = $this->getArg('id');

            $maybe = $this->getRepository()->getById($id);

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
