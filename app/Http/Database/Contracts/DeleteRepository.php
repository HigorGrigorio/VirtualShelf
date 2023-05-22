<?php

namespace App\Http\Database\Contracts;

interface DeleteRepository extends Repository
{
    public function delete(array $columns): int;
}
