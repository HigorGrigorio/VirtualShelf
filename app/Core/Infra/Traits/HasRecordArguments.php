<?php

namespace App\Core\Infra\Traits;

use App\Presentation\Helpers\DBHelper;
use Exception;
use Illuminate\Support\Str;

trait HasRecordArguments
{
    /**
     * @throws Exception
     */
    public function getTable(): string
    {
        throw new Exception('getTable() method must be implemented');
    }

    /**
     * @throws Exception
     */
    protected function getTablePlural(): string
    {
        return str_replace('_', '-', Str::plural($this->getTable()));
    }

    public function getColumns(): array
    {
        return $this->columns ?? [];
    }

    /**
     * @throws Exception
     */
    protected
    function getTableSingular(): string
    {
        return str_replace('_', '-', Str::singular($this->getTable()));
    }

    /**
     * @throws Exception
     */
    protected function getRouteName(): string
    {
        return 'tables.' . $this->getTableSingular();
    }

    /**
     * @throws Exception
     */
    protected function getRoute(string $name): string
    {
        return $this->getRouteName() . '.' . $name;
    }

    /**
     * @throws Exception
     */
    protected function getViewFolderPath(): string
    {
        return $this->getTableSingular();
    }

    /**
     * @throws Exception
     */
    protected function getViewPath(string $name): string
    {
        return $this->getViewFolderPath() . '.' . $name;
    }

    /**
     * @throws Exception
     */
    public function getRecordArgs(): array
    {
        $tables = DBHelper::getInstance()->getTables();

        return [
            'tables' => array_map(
                fn($table) => [
                    'name' => str_replace('_', '-', $table),
                    'singular' => Str::singular(str_replace('_', '-', $table)),
                    'plural' => Str::plural(str_replace('_', '-', $table)),
                    'index' => 'tables.' . Str::singular(str_replace('_', '-', $table)) . '.index',
                ],
                $tables
            ),
            'table' => $this->getTable(),
            'singular' => $this->getTableSingular(),
            'plural' => $this->getTablePlural(),
            'index' => 'tables.' . $this->getTableSingular() . '.index',
        ];
    }
}
