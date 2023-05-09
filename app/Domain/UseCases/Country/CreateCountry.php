<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\CreateRecord;
use App\Http\Database\Contracts\CountryRepository;

class CreateCountry extends CreateRecord
{
    public function __construct(
        CountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
