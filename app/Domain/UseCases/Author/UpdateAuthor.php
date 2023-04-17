<?php

namespace App\Domain\UseCases\Author;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Record\UpdateRecord;
use App\Interfaces\IAuthorRepository;

class UpdateAuthor extends UpdateRecord
{
    public function __construct(
        readonly IAuthorRepository $repository,
    )
    {
        parent::__construct($repository);
    }
}
