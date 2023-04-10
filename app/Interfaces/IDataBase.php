<?php

namespace App\Interfaces;

interface IDataBase
{
    public function getTables(): array;
    public function getTableColumns(string $table): array;
}
