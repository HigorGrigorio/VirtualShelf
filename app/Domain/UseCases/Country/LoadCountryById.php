<?php

namespace App\Domain\UseCases\Country;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\LoadRecordById;
use App\Interfaces\ICountryRepository;

class LoadCountryById extends LoadRecordById
{
    public function __construct(
        readonly ICountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
