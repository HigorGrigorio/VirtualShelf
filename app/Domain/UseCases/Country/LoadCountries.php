<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Contracts\CountryRepository;

class LoadCountries extends LoadRecords
{
    public function __construct(CountryRepository $countryRepository)
    {
        parent::__construct($countryRepository);
    }
}
