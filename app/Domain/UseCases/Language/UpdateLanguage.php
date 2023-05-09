<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\ILanguageRepository;

class UpdateLanguage extends UpdateRecord
{
    public function __construct(
        ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
