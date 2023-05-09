<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\CountryRepository;

class ExportCountries extends ExportRecord
{
    public function __construct(
        readonly CountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
