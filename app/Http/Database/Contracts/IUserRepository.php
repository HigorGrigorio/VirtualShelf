<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface IUserRepository extends IRepository
{
    public function getUserByFirstName($userName): Maybe;

    public function getUserByLastName($userName): Maybe;

    public function getUserByEmail($userName): Maybe;
}
