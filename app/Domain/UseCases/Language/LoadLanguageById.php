<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\LanguageRepository;

class LoadLanguageById extends LoadRecordById
{
    public function __construct(
        LanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
