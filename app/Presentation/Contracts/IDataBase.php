<?php

namespace App\Presentation\Contracts;

interface IDataBase
{
    public function getTables(): array;
    public function getTableColumns(string $table): array;
}
