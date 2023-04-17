<?php

namespace App\Http\Controllers\Traits;

use App\Core\Domain\IUseCase;
use App\Helpers\DBHelper;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

trait HandlesRecords
{
    /**
     * @throws Exception
     */
    public function getTable(): string
    {
        if (!isset($this->table)) {
            throw new Exception('Table not defined');
        }

        return $this->table;
    }

    /**
     * @throws Exception
     */
    public function getShowables(): array
    {
        return $this->showable ?? DBHelper::getInstance()->getFillables($this->getTable());
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
    protected
    function getRouteName(): string
    {
        return 'tables.' . $this->getTableSingular();
    }

    /**
     * @throws Exception
     */
    protected
    function getRoute(string $name): string
    {
        return $this->getRouteName() . '.' . $name;
    }

    /**
     * @throws Exception
     */
    protected
    function getRouteParams(array $params = []): array
    {
        return array_merge([
            'table' => $this->getTableSingular()
        ], $params);
    }

    /**
     * @throws Exception
     */
    protected
    function getRouteNamePlural(): string
    {
        return 'tables.' . $this->getTablePlural();
    }

    /**
     * @throws Exception
     */
    public
    function redirect(string $route, array...$params): RedirectResponse
    {
        $route = $this->getRoute($route);
        $params = $this->getRouteParams(array_merge(
            ...$params
        ));
        return redirect()->route($route, $params);
    }

    /**
     * @throws Exception
     */
    protected
    function getViewFolderPath(): string
    {
        return 'layout.' . $this->getTableSingular();
    }

    /**
     * @throws Exception
     */
    protected
    function getViewPath(string $name): string
    {
        return $this->getViewFolderPath() . '.' . $name;
    }

    /**
     * @throws Exception
     */
    public
    function getRecordParams(): array
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
            'singular' => $this->getTableSingular(),
            'plural' => $this->getTablePlural(),
            'index' => 'tables.' . $this->getTableSingular() . '.index',
        ];
    }

    public
    function getHelps($context): array
    {
        if (!isset($this->helps)) {
            return [];
        }

        if (isset($this->helps[$context])) {
            $helps = array_merge(
            // remove the context from the array
                $this->helps,
                $this->helps[$context]);
        } else {
            $helps = $this->helps;
        }

        // remove the contexts ['edit', 'update'] from the array
        return array_diff_key($helps, ['edit', 'update']);
    }

    /**
     * @throws Exception
     */
    protected
    function makeView(string $string, ...$params): \Illuminate\Contracts\View\View
    {
        if (!in_array($string, ['index', 'show', 'store', 'edit'])) {
            throw new Exception('Invalid view name');
        }

        // check if exists the view into table folder
        $folder = $this->getViewPath($string);

        if (View::exists($folder)) {
            $path = $this->getViewPath($string);
        }

        if (!isset($path)) {
            $path = 'layout.table.' . $string;
        }

        return view($path)->with(array_merge(
            $this->getRecordParams(),
            $this->getParams(),
            ...$params
        ));
    }
}
