<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private function getSession(string $key): array
    {
        $storage = Session::get($key, []);

        if(!is_array($storage))
            $storage = [];

        return $storage;
    }

    private function pushAlertNotification(string $key, string $message, string $title, int $code, int $timeout)
    {
        $storage = $this->getSession($key);

        $storage[] = [
            'title' => $title,
            'message' => $message,
            'code' => $code,
            'timeout' => $timeout
        ];

        Session::put($key, $storage);
    }

    public function success(string $message, string $title = '', int $code = 200, int $timeout = 5000)
    {
        $this->pushAlertNotification('success', $message, $title, $code, $timeout);
    }

    public function danger(string $message, string $title = '', int $code = 500, int $timeout = 5000)
    {
        $this->pushAlertNotification('danger', $message, $title, $code, $timeout);
    }

    public function warning(string $message, string $title = '', int $code = 200, int $timeout = 5000)
    {
        $this->pushAlertNotification('warning', $message, $title, $code, $timeout);
    }

    public function info(string $message, string $title = '', int $code = 200, int $timeout = 5000)
    {
        $this->pushAlertNotification('info', $message, $title, $code, $timeout);
    }
}
