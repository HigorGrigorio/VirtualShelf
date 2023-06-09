<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\AuthorRepository;

class ExportAuthors extends ExportRecord
{
    public function __construct(
        readonly AuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
