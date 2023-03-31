<?php

namespace App\Domain\UseCases;

use App\Core\Domain\UseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICountryRepository;

class LoadCountries implements UseCase
{
    public function __construct(private readonly ICountryRepository $countryRepository)
    {
    }

    public function execute($options): Result
    {
        try {
            $result = Result::accept(
                Maybe::flat($this->countryRepository->getAll($options)),
                'Countries loaded successfully',
            );
        } catch (\Exception $e) {
            $result = Result::reject(Maybe::just([]), $e->getMessage());
        }

        return $result;
    }
}
