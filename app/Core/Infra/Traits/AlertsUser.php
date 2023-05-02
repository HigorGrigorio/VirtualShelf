<?php

namespace App\Core\Infra\Traits;

use Exception;

trait AlertsUser
{
    protected function alert(string $type, string $message): void
    {
        session()->flash($type, $message);
    }

    protected function alertSuccess(string $message): void
    {
        $this->alert('success', $message);
    }

    protected function alertInfo(string $message): void
    {
        $this->alert('info', $message);
    }

    protected function alertWarning(string $message): void
    {
        $this->alert('warning', $message);
    }

    protected function alertDanger(string $message): void
    {
        $this->alert('danger', $message);
    }

    protected function pullAlerts()
    {
        $alerts = [];

        foreach (['success', 'danger', 'info', 'warning'] as $type) {
            $alerts[$type] = session()->pull($type);
        }

        return $alerts;
    }

    protected function getAlerts(): array
    {
        $alerts = [];

        try {
            foreach (['success', 'danger', 'info', 'warning'] as $type) {
                if (session()->has($type))
                    $alerts[$type] = session()->get($type);
                else
                    $alerts[$type] = null;
            }
        } catch (Exception) {
            $alerts = array_merge($alerts, [
                'success' => null,
                'danger' => null,
                'info' => null,
                'warning' => null,
            ]);
        }

        return $alerts;
    }
}
