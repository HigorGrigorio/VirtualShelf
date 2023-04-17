<?php

namespace App\Domain\UseCases\Author;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\LoadRecordById;
use App\Interfaces\IAuthorRepository;

class LoadAuthorById extends LoadRecordById
{
    public function __construct(
        readonly IAuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
