<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Repositories\CountryRepository;

class LoadCountries extends LoadRecords
{
    public function __construct(
        CountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
