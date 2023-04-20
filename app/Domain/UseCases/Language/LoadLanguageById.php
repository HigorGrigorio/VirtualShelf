<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Presentation\Interfaces\ILanguageRepository;

class LoadLanguageById extends LoadRecordById
{
    public function __construct(
        readonly ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
