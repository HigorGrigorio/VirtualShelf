<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\PaginateRecords;
use App\Http\Database\Contracts\LanguageRepository;

class PaginateLanguages extends PaginateRecords
{
    public function __construct(
        LanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
