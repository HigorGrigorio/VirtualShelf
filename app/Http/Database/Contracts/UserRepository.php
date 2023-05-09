<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface UserRepository extends Repository
{
    public function getUserByFirstName($userName): Maybe;

    public function getUserByLastName($userName): Maybe;

    public function getUserByEmail($userName): Maybe;
}
