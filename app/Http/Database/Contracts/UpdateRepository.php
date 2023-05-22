<?php

namespace App\Http\Database\Contracts;

interface UpdateRepository extends Repository
{
    public function update(array $columns, array $data): int;
}
