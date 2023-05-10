<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\PaginateRecords;
use App\Http\Database\Contracts\AuthorRepository;

class PaginateAuthors extends PaginateRecords
{
    public function __construct(
        AuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
