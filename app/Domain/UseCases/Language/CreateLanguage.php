<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\CreateRecord;
use App\Http\Database\Contracts\LanguageRepository;

class CreateLanguage extends CreateRecord
{
    public function __construct(
        LanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
