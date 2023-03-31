<?php

namespace App\Interfaces;

use App\Core\Logic\Maybe;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICountryRepository
{
    public function getAll(array $options): LengthAwarePaginator ;
    public function findById(int $id): Maybe;
    public function create(array $data): int;
    public function update(int $id, array $data): bool;
    public function delete(array $columns): int;
}
