<?php

namespace App\Domain\UseCases\Author;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\IAuthorRepository;

class ExportAuthors extends ExportRecord
{
    public function __construct(
        readonly IAuthorRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
