<?php

namespace App\Presentation\Helpers\Contracts;

interface IDataBase
{
    public function getTables(): array;
    public function getTableColumns(string $table): array;
}
