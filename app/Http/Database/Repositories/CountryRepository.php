<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Http\Database\Contracts\ICountryRepository;
use App\Models\Country;


class CountryRepository extends Repository implements ICountryRepository
{
    public function __construct(
        readonly Country $dao
    )
    {
        parent::__construct($dao);
    }

    /**
     * @param string $name
     *
     * @return Maybe<Country>
     */
    public function getByName(string $name): Maybe
    {
        return $this->getBy('name', $name);
    }

    /**
     * @param string $code
     *
     * @return Maybe<Country>
     */
    public function getByCode(string $code): Maybe
    {
        return $this->getBy('code', $code);
    }
}
