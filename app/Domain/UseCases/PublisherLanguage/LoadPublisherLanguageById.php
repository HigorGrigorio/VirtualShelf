<?php

namespace App\Domain\UseCases\PublisherLanguage;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\PublisherLanguageRepository;

class LoadPublisherLanguageById extends LoadRecordById
{
    public function __construct(
        PublisherLanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
