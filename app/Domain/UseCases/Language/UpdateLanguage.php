<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\LanguageRepository;

class UpdateLanguage extends UpdateRecord
{
    public function __construct(
        LanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
