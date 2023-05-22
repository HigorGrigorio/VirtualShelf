<?php

namespace App\Http\Database\Contracts;

use App\Core\Logic\Maybe;

interface PublisherRepository extends
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
    public function getPublisherByName(string $name): Maybe;

    public function getPublisherByEmail(string $code): Maybe;
}
