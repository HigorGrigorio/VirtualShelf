<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public        $id,
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
        public string $value = '',
        /**
         * The input placeholder.
         */
        public string $placeholder = '',
        /**
         * The input label.
         */
        public        $label = null,
        /**
         * The number of rows.
         */
        public int    $rows = 3,
/**
         * The number max of characters.
         */
        public int    $max = 0,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-area');
    }
}
