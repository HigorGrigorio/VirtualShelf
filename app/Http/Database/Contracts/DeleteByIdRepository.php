<?php

namespace App\Http\Database\Contracts;

interface DeleteByIdRepository extends Repository
{
    public function deleteById(int $id): int;
}
