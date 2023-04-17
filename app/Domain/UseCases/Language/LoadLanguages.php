<?php

namespace App\Domain\UseCases\Language;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Record\LoadRecords;
use App\Interfaces\IAuthorRepository;
use App\Interfaces\ILanguageRepository;
use Illuminate\Support\Facades\Config;

class LoadLanguages extends LoadRecords
{
    public function __construct(
        readonly ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
