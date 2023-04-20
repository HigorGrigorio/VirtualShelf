<?php

namespace App\Helpers;

use App\Helpers\Traits\Singleton;
use App\Interfaces\IDataBase;
use Illuminate\Support\Facades\DB;

class DBHelper implements IDataBase
{
    use Singleton;

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

    public function getFillables(string $table): array
    {
        return array_column(array_filter(
            $this->getTableColumns($table),
            function ($column) {
                return $column->Extra !== 'auto_increment' && // Exclude auto-incrementing primary keys
                    !in_array($column->Field, ['created_at', 'updated_at']) && // Exclude timestamps
                    !in_array($column->Field, ['PRI', 'MUL']); // Exclude primary and foreign keys
            }
        ), 'Field');
    }

    public function getPrimaryKey(string $table): string
    {
        $pk = array_filter($this->getTableColumns($table), function ($column) {
            return $column->Key === 'PRI';
        });

        return $pk[0]->Field;
    }
}
