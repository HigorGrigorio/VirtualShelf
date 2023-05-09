<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Contracts\AuthorRepository;

class LoadAuthors extends LoadRecords
{
    public function __construct(
        AuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
