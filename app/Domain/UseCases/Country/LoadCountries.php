<?php

namespace App\Domain\UseCases\Country;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\LoadRecords;
use App\Presentation\Contracts\ICountryRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class LoadCountries extends LoadRecords
{
    public function __construct(ICountryRepository $countryRepository)
    {
        parent::__construct($countryRepository);
    }
}
