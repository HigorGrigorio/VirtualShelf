<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface UserRepository extends
    CreateRepository,
    DeleteByIdRepository,
    DeleteRepository,
    ExportRepository,
    GetByIdRepository,
    PaginateRepository,
    UpdateByIdRepository,
    UpdateRepository
{
    public function getUserByFirstName($userName): Maybe;

    public function getUserByLastName($userName): Maybe;

    public function getUserByEmail($userName): Maybe;
}
