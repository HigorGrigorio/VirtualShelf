<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\AuthorRepository;

class UpdateAuthor extends UpdateRecord
{
    public function __construct(
        readonly AuthorRepository $repository,
    )
    {
        parent::__construct($repository);
    }
}
