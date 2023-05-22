<?php

namespace App\Http\Database\Repositories;

use App\Core\Logic\Maybe;
use App\Http\Database\Contracts\AuthorRepository as RepositoryContract;
use App\Models\Author;

class AuthorRepository extends Repository implements RepositoryContract
{
    use Traits\CreateRepository,
        Traits\DeleteById,
        Traits\DeleteRepository,
        Traits\ExportRepository,
        Traits\GetAllRepository,
        Traits\GetByIdRepository,
        Traits\PaginateRepository,
        Traits\UpdateByIdRepository,
        Traits\UpdateRepository;

    public function __construct(
        readonly Author $dao
    )
    {
        parent::__construct($dao);
    }

    /**
     * @param string $name
     *
     * @return Maybe<array<int,Author>>
     */
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
