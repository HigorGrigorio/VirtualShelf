<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Http\Database\Contracts\LanguageRepository;

class DeleteStateById extends DeleteRecord
{
    public function __construct(
        LanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
