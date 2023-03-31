<?php

namespace App\Domain\UseCases;

use App\Core\Domain\UseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICountryRepository;

class CreateCountry implements UseCase
{
    public function __construct(private readonly ICountryRepository $repository)
    {
    }

    public function execute($options): Result
    {
        try {
            $id = $this->repository->create($options);

            return Result::accept(Maybe::flat($id), 'Country created successfully');
        } catch (\Throwable $e) {
            return Result::reject(Maybe::nothing(), $e->getMessage());
        }
    }
}
