<?php

namespace App\Http\Database\Contracts;

interface UpdateByIdRepository extends Repository
{
    public function updateById(int $id, array $data): bool;
}
