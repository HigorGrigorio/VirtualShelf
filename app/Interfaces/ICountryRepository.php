<?php

namespace App\Interfaces;

use App\Core\Logic\Maybe;
use App\Models\Country;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICountryRepository extends IRepository
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
