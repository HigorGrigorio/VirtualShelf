<?php

namespace App\Domain\UseCases;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICountryRepository;

class LoadCountryById implements \App\Core\Domain\UseCase
{
    public function __construct(
        private readonly ICountryRepository $countryRepository
    )
    {
    }

    public function execute($options): Result
    {
        try {
            $id = $options['id'] ?? null;

            if (is_null($id))
                $result = Result::reject(Maybe::nothing(), 'Invalid country id');
            else {
                $maybe = $this->countryRepository->findById($id);

                if ($maybe->isNothing())
                    $result = Result::reject(Maybe::nothing(), 'Country not found');
                else
                    $result = Result::accept($maybe);
            }
        } catch (\Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
