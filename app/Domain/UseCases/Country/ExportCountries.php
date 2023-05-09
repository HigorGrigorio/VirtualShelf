<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\ExportRecord;
use App\Http\Database\Contracts\ICountryRepository;

class ExportCountries extends ExportRecord
{
    public function __construct(
        readonly ICountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
