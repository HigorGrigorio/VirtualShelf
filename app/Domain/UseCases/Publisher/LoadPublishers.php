<?php

namespace App\Domain\UseCases\Publisher;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Repositories\PublisherRepository;

class LoadPublishers extends LoadRecords
{
    public function __construct(
        PublisherRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
