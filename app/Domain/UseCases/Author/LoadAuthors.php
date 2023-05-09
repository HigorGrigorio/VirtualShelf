<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Contracts\IAuthorRepository;

class LoadAuthors extends LoadRecords
{
    public function __construct(
        IAuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
