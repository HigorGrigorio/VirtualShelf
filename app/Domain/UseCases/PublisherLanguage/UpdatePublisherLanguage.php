<?php

namespace App\Domain\UseCases\PublisherLanguage;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\PublisherLanguageRepository;

class UpdatePublisherLanguage extends UpdateRecord
{
    public function __construct(
        PublisherLanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
