<?php

namespace App\Utils;

use App\Interfaces\IDataBase;
use Illuminate\Support\Facades\DB;

class DataBase implements IDataBase
{
    public function getTables(): array
    {
        return array_diff(
            array_column(DB::select('SHOW TABLES'), 'Tables_in_' . env('DB_DATABASE')),
            ['migrations', 'failed_jobs', 'password_reset_tokens', 'personal_access_tokens']
        );
    }

    public function getTableColumns(string $table): array
    {
        return DB::select('SHOW COLUMNS FROM ' . $table);
    }
}
