<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Contracts\StateRepository;

class LoadState extends LoadRecords
{
    public function __construct(
        StateRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
