<?php

namespace App\Http\Database\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginateRepository extends Repository
{
    public function paginate(int $page, string $search = null, $limit = null, array $searchable = null): LengthAwarePaginator;
}
