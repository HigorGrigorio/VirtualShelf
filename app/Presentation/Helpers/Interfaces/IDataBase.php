<?php

namespace App\Presentation\Helpers\Interfaces;

interface IDataBase
{
    public function getTables(): array;
    public function getTableColumns(string $table): array;
}
