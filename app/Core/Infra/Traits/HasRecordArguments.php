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
        return Str::plural($this->getTable());
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
        return Str::singular($this->getTable());
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
