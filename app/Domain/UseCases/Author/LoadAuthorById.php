<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\AuthorRepository;

class LoadAuthorById extends LoadRecordById
{
    public function __construct(
        readonly AuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
