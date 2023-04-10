<?php

namespace App\View\Components;

use App\Interfaces\IDataBase;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class SideNav extends Component
{
    public array $tables;
    public string|null $currentEditingTable;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public IDataBase $dataBase
    )
    {
        $this->tables = $this->getTablesInSingularName();
        $this->currentEditingTable = $this->getCurrentEditingTable();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-nav');
    }

    private function getTables(): array
    {
       return $this->dataBase->getTables();
    }

    private function getTablesInSingularName(): array
    {
        $all = $this->getTables();

        $tables = array_diff(
            array_column($all, 'Tables_in_' . env('DB_DATABASE')),
            ['migrations', 'failed_jobs', 'password_reset_tokens', 'personal_access_tokens']
        );

        return array_map(function ($table) {
            return Str::singular(Str::studly($table)); // singular and capitalize words
        }, $tables);
    }

    private function getCurrentEditingTable(): string|null
    {
        $currentRoute = request()->route()->getName();

        if (Str::contains($currentRoute, 'table')) {
            $raw = Str::before(Str::after($currentRoute, 'table.'), '.');

            // singular and capitalize word
            return Str::singular(Str::studly($raw));
        }

        return null;
    }
}
