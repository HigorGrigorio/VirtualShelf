<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface StateRepository extends Repository
{
    public function getStateByName(string $name): Maybe;

    public function getStateByCode(string $code): Maybe;
}
