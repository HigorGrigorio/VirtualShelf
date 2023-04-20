<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Presentation\Interfaces\ILanguageRepository;

class DeleteLanguageById extends DeleteRecord
{
    public function __construct(
        readonly ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
