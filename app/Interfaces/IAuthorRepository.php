<?php

namespace App\Interfaces;

interface IAuthorRepository
{
    public function create(array $data): int;

    public function paginate(int $page, string $search = null, $limit = null): array;

    public function getAll($search): array;

    public function getAuthorById(int $id): array;

    public function getAuthorByName(string $name): array;

    public function getAuthorBySurname(string $surname): array;

    public function update(int $id, array $data): bool;

    public function delete(array $columns): int;
}
