<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\StateRepository;

class ExportStates extends ExportRecord
{
    public function __construct(
        readonly StateRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
