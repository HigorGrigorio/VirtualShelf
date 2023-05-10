<?php

namespace App\Domain\UseCases\Publisher;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Http\Database\Contracts\PublisherRepository;

class DeletePublisherById extends DeleteRecord
{
    public function __construct(
        PublisherRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
