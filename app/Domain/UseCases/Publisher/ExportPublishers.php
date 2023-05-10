<?php

namespace App\Domain\UseCases\Publisher;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\PublisherRepository;

class ExportPublishers extends ExportRecord
{
    public function __construct(
        readonly PublisherRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
