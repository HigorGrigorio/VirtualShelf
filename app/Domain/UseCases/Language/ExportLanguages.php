<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\ILanguageRepository;

class ExportLanguages extends ExportRecord
{
    public function __construct(
        readonly ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
