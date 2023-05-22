<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface CategoryRepository extends
    CreateRepository,
    DeleteByIdRepository,
    DeleteRepository,
    ExportRepository,
    GetByIdRepository,
    PaginateRepository,
    UpdateByIdRepository,
    UpdateRepository
{
    public function getCategoryByName(string $name): Maybe;
    public function getCategoryBySlug(string $slug): Maybe;
}
