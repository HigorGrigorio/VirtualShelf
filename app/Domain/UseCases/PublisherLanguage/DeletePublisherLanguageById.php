<?php

namespace App\Domain\UseCases\PublisherLanguage;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Http\Database\Contracts\PublisherLanguageRepository;

class DeletePublisherLanguageById extends DeleteRecord
{
    public function __construct(
        PublisherLanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
