<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Repositories\StateRepository;

class LoadStates extends LoadRecords
{
    public function __construct(
        StateRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
