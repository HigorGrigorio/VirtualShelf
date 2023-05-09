<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\LoadRecords;
use App\Http\Database\Contracts\ICountryRepository;

class LoadCountries extends LoadRecords
{
    public function __construct(ICountryRepository $countryRepository)
    {
        parent::__construct($countryRepository);
    }
}
