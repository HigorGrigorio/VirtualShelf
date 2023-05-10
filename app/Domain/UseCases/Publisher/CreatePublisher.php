<?php

namespace App\Domain\UseCases\Publisher;

use App\Domain\UseCases\Base\CreateRecord;
use App\Http\Database\Contracts\PublisherRepository;

class CreatePublisher extends CreateRecord
{
    public function __construct(
        PublisherRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
