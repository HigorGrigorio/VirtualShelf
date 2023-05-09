<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\LanguageRepository;

class ExportLanguages extends ExportRecord
{
    public function __construct(
        readonly LanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
