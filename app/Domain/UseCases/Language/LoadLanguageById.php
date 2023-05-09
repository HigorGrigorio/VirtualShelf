<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\ILanguageRepository;

class LoadLanguageById extends LoadRecordById
{
    public function __construct(
        ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
