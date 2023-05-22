<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;
use App\Models\Country;

interface CountryRepository extends
    CreateRepository,
    DeleteByIdRepository,
    DeleteRepository,
    ExportRepository,
    GetByIdRepository,
    PaginateRepository,
    UpdateByIdRepository,
    UpdateRepository
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
