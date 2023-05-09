<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\CreateRecord;
use App\Http\Database\Contracts\ILanguageRepository;

class CreateLanguage extends CreateRecord
{
    public function __construct(
        ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
