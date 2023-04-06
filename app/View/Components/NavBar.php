<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class NavBar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $currentPage = [],
    )
    {

        $this->currentPage = $this->getCurrentRoute();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }

    private function getCurrentRoute(): array
    {
        $raw = request()->route()->uri;

        // filter the args from the uri
        $raw = array_filter(explode('/', $raw), function ($item) {
            return !Str::contains($item, '{');
        });

        return array_map(function ($route) {
            // capitalize first letter of each word
            return Str::ucfirst($route);
        }, $raw);
    }
}
