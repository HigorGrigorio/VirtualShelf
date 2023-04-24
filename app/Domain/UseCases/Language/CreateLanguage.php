<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\CreateRecord;
use App\Presentation\Interfaces\ILanguageRepository;

class CreateLanguage extends CreateRecord
{
    public function __construct(
        ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
