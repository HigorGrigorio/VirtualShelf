<?php

namespace App\Http\Controllers;

use App\Core\Domain\IUseCase;
use App\Core\Logic\Result;
use App\Helpers\DBHelper;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private ?Request $request = null;

    /**
     * @var array<string,IUseCase> $useCases
     */
    protected array $useCases = [];

    /**
     * @throws Exception
     */
    public function getUseCase(string $name): IUseCase
    {
        if (!key_exists($name, $this->useCases)) {
            throw new Exception("Use case '$name' not defined");
        }

        return $this->useCases[$name];
    }

    public function setUseCase(string $name, IUseCase $useCase): void
    {
        $this->useCases[$name] = $useCase;
    }

    public function setUseCases(array $useCases): void
    {
        $this->useCases = array_merge($this->useCases, $useCases);
    }

    public function getUseCases(): array
    {
        return $this->useCases;
    }

    public function removeUseCase(string $name): void
    {
        if (key_exists($name, $this->useCases))
            unset($this->useCases[$name]);
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @throws Exception
     */
    public function getRequest(): Request
    {
        if (!isset($this->request))
            throw new Exception('Request not defined');

        return $this->request;
    }

    /**
     * @throws Exception
     */
    protected function getPaginationParams(): array
    {
        return array_merge(
            [
                'search' => '',
                'page' => Config::get('app.pagination.default_index_page'),
                'limit' => Config::get('app.pagination.limit'),
                'limits' => Config::get('app.pagination.limits'),
            ],
            $this->getRequest()->all(['page', 'limit', 'search']),
        );
    }

    /**
     * @throws Exception
     */
    public function getParams(array...$params): array
    {
        return array_merge(
            $this->getPaginationParams(),
            ...$params
        );
    }

    private function getSessionKey(string $key): array
    {
        $storage = Session::get($key, []);

        if (!is_array($storage))
            $storage = [];

        return $storage;
    }

    private function pushAlertNotification(string $key, string $message, string $title, int $code, int $timeout): void
    {
        $storage = $this->getSessionKey($key);

        $storage[] = [
            'title' => $title,
            'message' => $message,
            'code' => $code,
            'timeout' => $timeout
        ];

        Session::put($key, $storage);
    }

    public function success(Result $result): void
    {
        $this->pushAlertNotification('success', $result->getMessage(), 'Success', 200, 5000);
    }

    public function danger(Result $result): void
    {
        $this->pushAlertNotification('danger', $result->getMessage(), 'Error', 500, 5000);
    }

    public function warning(Result $result): void
    {
        $this->pushAlertNotification('warning', $result->getMessage(), 'Warning', 200, 5000);
    }

    public function info(Result $result): void
    {
        $this->pushAlertNotification('info', $result->getMessage(), 'Info', 200, 5000);
    }
}
