<?php

namespace App\Domain\UseCases\PublisherLanguage;

use App\Domain\UseCases\Base\PaginateRecords;
use App\Http\Database\Contracts\PublisherLanguageRepository;

class PaginatePublisherLanguages extends PaginateRecords
{
    public function __construct(
        readonly PublisherLanguageRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
