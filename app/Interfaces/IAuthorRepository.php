<?php

namespace App\Interfaces;

use App\Core\Logic\Maybe;
use App\Models\Author;

interface IAuthorRepository
{
    public function create(array $data): int;

    public function paginate(int $page, string $search = null, $limit = null): array;

    public function getAll(string $search): array;

    /**
     * @param int $id
     *
     * @return Maybe<Author>
     */
    public function getAuthorById(int $id): Maybe;

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

    public function update(int $id, array $data): bool;

    public function delete(array $columns): int;
}
