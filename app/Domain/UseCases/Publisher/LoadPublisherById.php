<?php

namespace App\Domain\UseCases\Publisher;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\PublisherRepository;

class LoadPublisherById extends LoadRecordById
{
    public function __construct(
        PublisherRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
