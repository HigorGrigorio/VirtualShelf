<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\PaginateRecords;
use App\Http\Database\Contracts\CountryRepository;

class PaginateCountries extends PaginateRecords
{
    public function __construct(CountryRepository $countryRepository)
    {
        parent::__construct($countryRepository);
    }
}
