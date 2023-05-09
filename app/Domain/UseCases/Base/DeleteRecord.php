<?php

namespace App\Domain\UseCases\Base;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\UseCase;
use App\Http\Database\Contracts\IRepository;
use Exception;

class DeleteRecord extends UseCase
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
            if($this->getArg('id') === null) {
                throw new Exception('Id is required');
            }

            $id = $this->getArg('id');

            if ($this->getRepository()->delete(['id' => $id]) === 0)
                $result = Result::reject(
                    Maybe::nothing(),
                    'Record not found'
                );
            else
                $result = Result::accept(
                    Maybe::just(1),
                    'Record deleted successfully'
                );
        } catch (Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }

    public static function create(IRepository $repository): DeleteRecord
    {
        return new DeleteRecord($repository);
    }
}
