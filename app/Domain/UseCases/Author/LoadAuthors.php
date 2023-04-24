<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\LoadRecords;
use App\Presentation\Interfaces\IAuthorRepository;

class LoadAuthors extends LoadRecords
{
    public function __construct(
        IAuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
