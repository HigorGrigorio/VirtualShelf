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
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $table,
        public array  $tables,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-nav');
    }
}
