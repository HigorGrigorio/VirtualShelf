<?php

namespace App\Domain\UseCases\Publisher;

use App\Domain\UseCases\Base\PaginateRecords;
use App\Http\Database\Contracts\PublisherRepository;

class PaginatePublishers extends PaginateRecords
{
    public function __construct(
        PublisherRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
