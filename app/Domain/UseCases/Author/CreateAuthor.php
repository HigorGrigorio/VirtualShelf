<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\CreateRecord;
use App\Presentation\Interfaces\IAuthorRepository;

class CreateAuthor extends CreateRecord
{
    public function __construct(
        readonly IAuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
