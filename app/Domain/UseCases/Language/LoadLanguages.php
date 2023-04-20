<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\LoadRecords;
use App\Presentation\Interfaces\ILanguageRepository;

class LoadLanguages extends LoadRecords
{
    public function __construct(
        readonly ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
