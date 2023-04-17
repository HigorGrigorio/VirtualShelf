<?php

namespace App\Domain\UseCases\Author;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\CreateRecord;
use App\Interfaces\IAuthorRepository;

class CreateAuthor extends CreateRecord
{
    public function __construct(
        readonly IAuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
