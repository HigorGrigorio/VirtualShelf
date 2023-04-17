<?php

namespace App\View\Components;

use App\Helpers\DBHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class NavBar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array     $breadCrumb = [],
    )
    {
        $this->breadCrumb = $this->getBreadCrumb();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }

    public function getBreadCrumb(): array
    {
        $routeName = Route::currentRouteName();

        $routePath = Route::getCurrentRoute()->uri();

        $nameParts = explode('.', $routeName);
        $pathParts = explode('/', $routePath);

        $breadCrumb = [];

        $partialRoute = '';
        $tables = DBHelper::getInstance()->getTables();

        for ($i = 0; $i < count($pathParts); $i++) {
            if (count($nameParts) - 1 < $i) {
                break;
            }

            // To routes like: /tables/{table}*s
            $nameParts[$i] = Str::lcfirst($nameParts[$i]);

            if (in_array(Str::plural(Str::plural($nameParts[$i])), $tables)) {
                // parse table name from route
                $route = $partialRoute . '/' . Str::plural($nameParts[$i]);

            } else {
                $route = $partialRoute . '/' . $pathParts[$i];
            }

            $partialRoute .= '/' . $pathParts[$i];

            $breadCrumbItem = [
                'name' => ucfirst($nameParts[$i]),
                'route' => $route
            ];

            if ($i == count($nameParts) - 1) {
                $breadCrumbItem['route'] = null;
            }

            $breadCrumb[] = $breadCrumbItem;
        }

        return $breadCrumb;
    }
}
