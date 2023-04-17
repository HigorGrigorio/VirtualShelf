<?php

namespace App\Domain\UseCases\Language;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Record\UpdateRecord;
use App\Interfaces\ILanguageRepository;

class UpdateLanguage extends UpdateRecord
{
    public function __construct(
        readonly ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
