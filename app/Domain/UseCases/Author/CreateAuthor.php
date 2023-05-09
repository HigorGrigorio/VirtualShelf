<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\CreateRecord;
use App\Http\Database\Contracts\AuthorRepository;

class CreateAuthor extends CreateRecord
{
    public function __construct(
        AuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
