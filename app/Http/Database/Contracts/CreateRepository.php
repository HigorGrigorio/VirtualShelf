<?php

namespace App\Http\Database\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CreateRepository extends Repository
{
    public function create(array $data): Model;
}
