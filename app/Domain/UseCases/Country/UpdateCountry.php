<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\UpdateRecord;
use App\Http\Database\Contracts\ICountryRepository;

class UpdateCountry extends UpdateRecord
{
    public function __construct(
        ICountryRepository $repository,
    )
    {
        parent::__construct($repository);
    }
}
