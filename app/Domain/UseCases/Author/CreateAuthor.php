<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\CreateRecord;
use App\Presentation\Contracts\IAuthorRepository;

class CreateAuthor extends CreateRecord
{
    public function __construct(
        IAuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
