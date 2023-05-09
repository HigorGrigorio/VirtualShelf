<?php

namespace App\Domain\UseCases\Base;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\UseCase;
use App\Http\Database\Contracts\Repository;
use Throwable;

class CreateRecord extends UseCase
{
    public function __construct(
        Repository $repository
    )
    {
        parent::__construct($repository);
    }

    public function execute(): Result
    {
        try {
            $id = $this->getRepository()->create($this->getArgs());
            $result = Result::accept(Maybe::flat($id), 'Resource created successfully');
        } catch (Throwable $e) {
            $result = Result::from($e);
        }

        return $result;
    }

    public static function create(Repository $repository): CreateRecord
    {
        return new CreateRecord($repository);
    }
}
