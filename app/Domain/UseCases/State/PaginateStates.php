<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\PaginateRecords;
use App\Http\Database\Contracts\StateRepository;

class PaginateStates extends PaginateRecords
{
    public function __construct(
        StateRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
