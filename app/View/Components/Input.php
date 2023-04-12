<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public        $id,
        /**
         * The input type.
         */
        public string $type,
        /**
         * The input name.
         */
        public string $name,
        /**
         * The help text displayed below the input.
         */
        public        $help = null,
        /**
         * The input value.
         */
        public        $value = null,
        /**
         * The input label.
         */
        public        $label = null,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
