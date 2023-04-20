<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\LoadRecordById;
use App\Presentation\Interfaces\ICountryRepository;

class LoadCountryById extends LoadRecordById
{
    public function __construct(
        readonly ICountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
