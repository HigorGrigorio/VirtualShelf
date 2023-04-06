<?php

namespace App\Domain\UseCases;

use App\Core\Domain\UseCase;
use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICountryRepository;

class DeleteCountryById implements UseCase
{
    public function __construct(
        private readonly ICountryRepository $countryRepository,
    )
    {
    }

    public function execute($options): Result
    {
        try {
            $id = $options['id'] ?? null;
            if (is_null($id))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Invalid country id'
                );
            else {
                if ($this->countryRepository->delete(['id' => $id]) == 0)
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Country not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(1),
                        'Country deleted successfully'
                    );
            }
        } catch (\Exception $e) {
            return Result::from($e);
        }

        return $result;
    }
}
