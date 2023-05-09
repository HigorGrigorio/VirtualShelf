<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Http\Database\Contracts\CountryRepository;

class DeleteCountryById extends DeleteRecord
{
    public function __construct(
        CountryRepository $repository,
    )
    {
        parent::__construct($repository);
    }
}
