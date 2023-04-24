<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Presentation\Interfaces\IAuthorRepository;

class DeleteAuthorById extends DeleteRecord
{
    public function __construct(
        IAuthorRepository $repository,
    )
    {
        parent::__construct($repository);
    }
}
