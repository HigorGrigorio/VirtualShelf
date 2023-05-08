<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\CreateRecord;
use App\Presentation\Contracts\ICountryRepository;

class CreateCountry extends CreateRecord
{
    public function __construct(
        ICountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
