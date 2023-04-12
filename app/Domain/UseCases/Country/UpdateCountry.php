<?php

namespace App\Domain\UseCases\Country;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Interfaces\ICountryRepository;

class UpdateCountry implements \App\Core\Domain\IUseCase
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
                $raw = [
                    'name' => $options['name'],
                    'code' => $options['code'],
                ];

                $id = $options['id'];


                if (!$this->countryRepository->update($raw, compact('id')))
                    $result = Result::reject(
                        Maybe::nothing(),
                        'Country not found'
                    );
                else
                    $result = Result::accept(
                        Maybe::just(
                            $this->countryRepository->getById($id)
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
