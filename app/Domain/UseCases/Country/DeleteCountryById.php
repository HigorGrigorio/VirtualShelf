<?php

namespace App\Domain\UseCases\Country;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\Record\DeleteRecord;
use App\Interfaces\ICountryRepository;

class DeleteCountryById extends DeleteRecord
{
    public function __construct(
        readonly ICountryRepository $repository,
    )
    {
        parent::__construct($this->repository);
    }
}
