<?php

namespace App\Domain\UseCases\Language;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\DeleteRecord;
use App\Interfaces\IAuthorRepository;
use App\Interfaces\ILanguageRepository;

class DeleteLanguageById extends DeleteRecord
{
    public function __construct(
        readonly ILanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
