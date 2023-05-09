<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\CountryRepository;

class UpdateCountry extends UpdateRecord
{
    public function __construct(
        CountryRepository $repository,
    )
    {
        parent::__construct($repository);
    }
}
