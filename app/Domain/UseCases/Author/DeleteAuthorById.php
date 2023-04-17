<?php

namespace App\Domain\UseCases\Author;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Record\DeleteRecord;
use App\Interfaces\IAuthorRepository;

class DeleteAuthorById extends DeleteRecord
{
    public function __construct(
        readonly IAuthorRepository $repository,
    )
    {
        parent::__construct($this->repository);
    }
}
