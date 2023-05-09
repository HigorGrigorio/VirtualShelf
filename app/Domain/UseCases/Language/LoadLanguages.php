<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Contracts\LanguageRepository;

class LoadLanguages extends LoadRecords
{
    public function __construct(
        LanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
