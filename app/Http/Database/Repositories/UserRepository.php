<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Models\User;
use App\Presentation\Contracts\IUserRepository;

class UserRepository extends Repository implements IUserRepository
{
    public function __construct(
        readonly User $dao
    )
    {
        parent::__construct($dao);
    }

    public function getUserByFirstName($userName): Maybe
    {
        return $this->getBy('name', $userName);
    }

    public function getUserByLastName($userName): Maybe
    {
        return $this->getBy('surname', $userName);
    }

    public function getUserByEmail($userName): Maybe
    {
        return $this->getBy('email', $userName);
    }
}
