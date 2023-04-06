<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class App extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $currentPage = [],
    )
    {
        if (empty($this->currentPage)) {
            $this->currentPage = $this->getCurrentRoute();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.app');
    }

    private function getCurrentRoute(): array
    {
        $raw = request()->route()->getName();

        return array_map(function ($route) {
            // Capitalize first letter of each word
            return Str::ucfirst($route);
        }, explode('/', $raw));
    }
}
