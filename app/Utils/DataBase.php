<?php

namespace App\Utils;

use App\Interfaces\IDataBase;
use Illuminate\Support\Facades\DB;

class DataBase implements IDataBase
{
    public function getTables(): array
    {
        return DB::select('SHOW TABLES');
    }

    public function getTableColumns(string $table): array
    {
        return DB::select('SHOW COLUMNS FROM ' . $table);
    }
}
