<?php

namespace App\View\Components;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public array $data = [];

    public ?array $actions = null;

    /**
     * Create a new component instance.
     *
     * @throws Exception
     */
    public function __construct(
        public $columns,
        public $pagination
    )
    {
        $this->init();
    }

    /**
     *
     * private function getValue($item, $column, $key, $alias)
     * {
     * if(is_array($column)) {
     * return $this->getValue($item, $column[$alias], $key, $alias);
     * }
     *
     * if(is_callable($column)) {
     * return $column($item);
     * }
     *
     * return $item->{$key};
     * }
     *
     * private function init(): void
     * {
     * $this->actions = $this->columns['actions'] ?? [];
     *
     * foreach ($this->pagination->items() as $item) {
     * $row = [];
     * foreach ($this->columns as $key => $column) {
     * if($key == 'actions') {
     * continue;
     * }
     *
     * $row[$key] = $this->getValue($item, $column, $key, 'value');
     * }
     * $this->data[] = $row;
     * }
     *
     *
     * }
     */

    protected function getActions(): array
    {
        return $this->actions ?? $this->columns['actions'] ?? [];
    }

    protected function unwrap($item, $column, $key, $alias): string
    {
        if (is_array($column)) {
            $type = $column['type'] ?? $alias;
            switch ($type) {
                case 'value':
                    return $this->unwrap($item, $column[$alias], $key, $alias);
                case 'html':
                    $value = $column[$alias];
                    foreach ($column['bind'] as $bind) {
                        $value = str_replace('${' . $bind . '}', $item->{$bind}, $value);
                    }
                    return $value;
                case 'callback':
                    return $column[$alias]($item);
            }
        }

        if (is_callable($column)) {
            return $column($item);
        }

        return $item->{$key};
    }

    /**
     * @throws Exception
     */
    public function init(): void
    {
        $this->actions = $this->getActions();

        foreach ($this->pagination->items() as $item) {
            $row = [];
            foreach ($this->columns as $key => $column) {
                if ($key == 'actions') {
                    continue;
                }

                $row[$key] = $this->unwrap($item, $column, $key, 'value');
            }
            $this->data[] = $row;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table', [
            'data' => $this->data,
            'columns' => $this->columns,
            'actions' => $this->actions,
            'pagination' => $this->pagination
        ]);
    }
}
