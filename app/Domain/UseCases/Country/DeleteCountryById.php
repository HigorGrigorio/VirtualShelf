<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Presentation\Contracts\ICountryRepository;

class DeleteCountryById extends DeleteRecord
{
    public function __construct(
        ICountryRepository $repository,
    )
    {
        parent::__construct($repository);
    }
}
