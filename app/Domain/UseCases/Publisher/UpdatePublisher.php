<?php

namespace App\Domain\UseCases\Publisher;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\PublisherRepository;

class UpdatePublisher extends UpdateRecord
{
    public function __construct(
        PublisherRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
