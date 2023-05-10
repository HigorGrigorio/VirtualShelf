<?php

namespace App\Domain\UseCases\State;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Repositories\CountryRepository;

class LoadStates extends LoadRecords
{
    public function __construct(
        CountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
