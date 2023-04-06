<?php

namespace App\Domain\UseCases;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICountryRepository;

class UpdateCountry implements \App\Core\Domain\UseCase
{

    public function __construct(
        private readonly ICountryRepository $countryRepository,
    )
    {
    }

    public function execute($options): Result
    {
        try {
            if (!isset($options['id']))
                $result = Result::reject(
                    Maybe::nothing(),
                    'Country id is required'
                );
            else {
                $id = $options['id'];

                if (!$this->countryRepository->update($id, $options))
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Country not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(
                            $this->countryRepository->findById($id)
                        ),
                        'Country updated successfully'
                    );
            }

        } catch (\Exception $e) {
            $result = Result::from($e);
        }

        return $result;
    }
}
