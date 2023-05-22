<?php

namespace App\Http\Database\Contracts;

interface GetAllRepository extends Repository
{
    public function getAll(): array;
}
