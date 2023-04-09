<?php

namespace App\Interfaces;

use App\Core\Logic\Maybe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IRepository
{
    public function create(array $data): array;

    public function delete(array $columns): int;

    public function deleteById(int $id): int;

    public function getAll(): array;

    public function getBy(string $column, string $value): Maybe;

    public function getById(int $id): Maybe;

    public function getDao(): Model;

    public function paginate(int $page, string $search = null, $limit = null, array $searchable = null): LengthAwarePaginator;

    public function update(array $columns, array $data): int;

    public function updateById(int $id, array $data): bool;

}
