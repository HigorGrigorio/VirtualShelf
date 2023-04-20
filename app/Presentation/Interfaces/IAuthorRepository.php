<?php

namespace App\Presentation\Interfaces;

use App\Core\Logic\Maybe;
use App\Models\Author;

interface IAuthorRepository extends IRepository
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
