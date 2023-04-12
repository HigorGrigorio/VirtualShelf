<?php

namespace App\Domain\UseCases\Country;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICountryRepository;

class CreateCountry implements IUseCase
{
    public function __construct(private readonly ICountryRepository $repository)
    {
    }

    public function execute($data): Result
    {
        try {
            $data = [
                'name' => $data['name'],
                'code' => $data['code'],
            ];

            $id = $this->repository->create($data);

            return Result::accept(Maybe::flat($id), 'Country created successfully');
        } catch (\Throwable $e) {
            return Result::reject(Maybe::nothing(), $e->getMessage());
        }
    }
}
