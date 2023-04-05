<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The alert icon.
     */
    public string $icon = '';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $type,
        public string $message,
        public string $title = '',
        public $timeout = null,
    )
    {
        $this->icon = $this->getIcon($type);

        if ($this->title === '') {
            $this->title = $this->getTitle($type);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }

    private function getIcon($type): string
    {
        $icons = [
            'success' => 'fa fa-check-circle',
            'danger' => 'fa fa-exclamation-circle',
            'warning' => 'fa fa-exclamation-triangle',
            'info' => 'fa fa-info-circle',
        ];

        return $icons[$type];
    }

    private function getTitle($type): string
    {
        return ucfirst($type);
    }
}
