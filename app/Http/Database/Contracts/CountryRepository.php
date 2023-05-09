<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;
use App\Models\Country;

interface CountryRepository extends Repository
{
    /**
     * @param string $name
     *
     * @return Maybe<Country>
     */
    public function getByName(string $name): Maybe;

    /**
     * @param string $code
     *
     * @return Maybe<Country>
     */
    public function getByCode(string $code): Maybe;
}
