<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\CountryRepository;

class LoadCountryById extends LoadRecordById
{
    public function __construct(
        CountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
