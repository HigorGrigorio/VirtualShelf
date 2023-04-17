<?php

namespace App\Domain\UseCases\Country;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Base\CreateRecord;
use App\Interfaces\ICountryRepository;

class CreateCountry extends CreateRecord
{
    public function __construct(
        readonly ICountryRepository $repository
    )
    {
        parent::__construct($repository);
    }
}
