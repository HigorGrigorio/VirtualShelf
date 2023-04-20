<?php

namespace App\Domain\UseCases\Country;

use App\Domain\UseCases\Base\DeleteRecord;
use App\Presentation\Interfaces\ICountryRepository;

class DeleteCountryById extends DeleteRecord
{
    public function __construct(
        readonly ICountryRepository $repository,
    )
    {
        parent::__construct($this->repository);
    }
}
