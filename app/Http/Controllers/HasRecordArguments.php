<?php

namespace App\Http\Controllers;

use App\Presentation\Helpers\DBHelper;
use Illuminate\Support\Str;

trait HasRecordArguments
{
    public function getTable(): string
    {
        return $this->table ?? '';
    }

    protected function getTablePlural(): string
    {
        return Str::plural($this->getTable());
    }

    public function getColumns(): array
    {
        return $this->columns ?? [];
    }

    protected
    function getTableSingular(): string
    {
        return Str::singular($this->getTable());
    }

    protected function getRouteName(): string
    {
        return 'tables.' . $this->getTableSingular();
    }

    protected function getRoute(string $name): string
    {
        return $this->getRouteName() . '.' . $name;
    }

    protected function getViewFolderPath(): string
    {
        return $this->getTableSingular();
    }

    protected function getViewPath(string $name): string
    {
        return $this->getViewFolderPath() . '.' . $name;
    }

    public function getRecordArgs(): array
    {
        return [
            'tables' => array_map(
                fn($table) => [
                    'name' => $table,
                    'singular' => Str::singular($table),
                    'plural' => Str::plural($table),
                    'index' => 'tables.' . Str::singular($table) . '.index',
                ],
                DBHelper::getInstance()->getTables(),
            ),
            'table' => $this->getTable(),
            'singular' => $this->getTableSingular(),
            'plural' => $this->getTablePlural(),
            'index' => 'tables.' . $this->getTableSingular() . '.index',
        ];
    }
}
