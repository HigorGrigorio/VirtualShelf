<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Presentation\Interfaces\IAuthorRepository;

class LoadAuthorById extends LoadRecordById
{
    public function __construct(
        readonly IAuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
