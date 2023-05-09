<?php

namespace App\Domain\UseCases\Language;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Http\Database\Contracts\LanguageRepository;

class DeleteLanguageById extends DeleteRecord
{
    public function __construct(
        LanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
