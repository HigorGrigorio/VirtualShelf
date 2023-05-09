<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Http\Database\Contracts\ICountryRepository;

class LoadCountryById extends LoadRecordById
{
    public function __construct(
        ICountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
