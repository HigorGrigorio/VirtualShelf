<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface LanguageRepository extends
    CreateRepository,
    DeleteByIdRepository,
    DeleteRepository,
    ExportRepository,
    GetByIdRepository,
    PaginateRepository,
    UpdateByIdRepository,
    UpdateRepository,
    GetAllRepository
{
    public function getLanguageByName(string $name): Maybe;

    public function getLanguageByCode(string $code): Maybe;
}
