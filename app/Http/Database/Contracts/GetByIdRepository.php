<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface GetByIdRepository extends Repository
{
    public function getById(int $id): Maybe;
}
