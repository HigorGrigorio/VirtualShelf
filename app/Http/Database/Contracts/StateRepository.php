<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface StateRepository extends
    CreateRepository,
    DeleteByIdRepository,
    DeleteRepository,
    ExportRepository,
    GetByIdRepository,
    PaginateRepository,
    UpdateByIdRepository,
    UpdateRepository
{
    public function getStateByName(string $name): Maybe;

    public function getStateByCode(string $code): Maybe;
}
