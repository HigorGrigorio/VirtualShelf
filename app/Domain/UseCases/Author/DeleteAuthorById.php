<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Http\Database\Contracts\AuthorRepository;

class DeleteAuthorById extends DeleteRecord
{
    public function __construct(
        AuthorRepository $repository,
    )
    {
        parent::__construct($repository);
    }
}
