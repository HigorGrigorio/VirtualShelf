<?php

namespace App\Presentation\Interfaces;

interface IDataBase
{
    public function getTables(): array;
    public function getTableColumns(string $table): array;
}
