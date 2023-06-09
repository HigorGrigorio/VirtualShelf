<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;
use App\Models\Author;

interface AuthorRepository extends
    CreateRepository,
    DeleteByIdRepository,
    DeleteRepository,
    ExportRepository,
    GetByIdRepository,
    PaginateRepository,
    UpdateByIdRepository,
    UpdateRepository
{
    /**
     * @param string $name
     *
     * @return Maybe<Author>
     */
    public function getAuthorByName(string $name): Maybe;

    /**
     * @param string $surname
     *
     * @return Maybe<array<int,Author>>
     */
    public function getAuthorBySurname(string $surname): Maybe;
}
