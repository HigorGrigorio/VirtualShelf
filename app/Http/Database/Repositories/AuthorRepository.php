<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Interfaces\IAuthorRepository;
use App\Models\Author;

class AuthorRepository extends Repository implements IAuthorRepository
{
    public function __construct(
        readonly Author $dao
    )
    {
        parent::__construct($dao);
    }

    public function getAuthorById(int $id): Maybe
    {
        return $this->getBy('id', $id);
    }

    public function getAuthorByName(string $name): Maybe
    {
        return $this->getBy('name', $name);
    }

    /**
     * @param string $surname
     *
     * @return Maybe<array<int,Author>>
     */
    public function getAuthorBySurname(string $surname): Maybe
    {
        return $this->getBy('surname', $surname);
    }
}
