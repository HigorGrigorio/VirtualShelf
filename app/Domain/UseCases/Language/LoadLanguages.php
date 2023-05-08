<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\LoadRecords;
use App\Presentation\Contracts\ILanguageRepository;

class LoadLanguages extends LoadRecords
{
    public function __construct(
        ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
