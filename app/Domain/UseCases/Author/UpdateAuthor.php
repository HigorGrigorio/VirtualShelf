<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Presentation\Contracts\IAuthorRepository;

class UpdateAuthor extends UpdateRecord
{
    public function __construct(
        readonly IAuthorRepository $repository,
    )
    {
        parent::__construct($repository);
    }
}
