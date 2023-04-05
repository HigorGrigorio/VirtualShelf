<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class AlertContainer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array $alerts = [])
    {
        $this->init();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-container');
    }

    private function init()
    {
        // counter to prevent duplicate ids.
        $count = 0;

        foreach (['success', 'danger', 'warning', 'info'] as $type) {
            if (Session::has($type)) {
                foreach (Session::get($type, []) as $alert) {
                    $this->alerts[] = [
                        'id' => $type . $count++,
                        'type' => $type,
                        'message' => $alert['message'],
                        'title' => $alert['title'],
                        'code' => $alert['code'] ?? '',
                        'timeout' => $alert['timeout']
                    ];
                }
                Session::forget($type);
            }
        }
    }
}
