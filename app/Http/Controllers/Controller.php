<?php

namespace App\Http\Controllers;

use App\Core\Logic\Result;
use App\Core\Logic\ResultStatus;
use App\Presentation\Helpers\DBHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private Request $request;

    private Result $result;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function setResult(Result $result): void
    {
        $this->result = $result;
    }


    public function getResult(): Result|null
    {
        return $this->result;
    }

    public function getTable(): string
    {
        return $this->table ?? '';
    }

    protected function getTablePlural(): string
    {
        return Str::plural($this->getTable());
    }

    public function getColumns(): array
    {
        return $this->columns ?? [];
    }

    protected
    function getTableSingular(): string
    {
        return Str::singular($this->getTable());
    }

    protected function getRouteName(): string
    {
        return 'tables.' . $this->getTableSingular();
    }

    protected function getRoute(string $name): string
    {
        return $this->getRouteName() . '.' . $name;
    }

    protected function getViewFolderPath(): string
    {
        return 'layout.' . $this->getTableSingular();
    }

    protected function getViewPath(string $name): string
    {
        return $this->getViewFolderPath() . '.' . $name;
    }

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

    public function getRecordParams(): array
    {
        return [
            'tables' => array_map(
                fn($table) => [
                    'name' => $table,
                    'singular' => Str::singular($table),
                    'plural' => Str::plural($table),
                    'index' => 'tables.' . Str::singular($table) . '.index',
                ],
                DBHelper::getInstance()->getTables(),
            ),
            'table' => $this->getTable(),
            'singular' => $this->getTableSingular(),
            'plural' => $this->getTablePlural(),
            'index' => 'tables.' . $this->getTableSingular() . '.index',
        ];
    }

    public function getParams(array...$params): array
    {
        return array_merge(
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

    protected function success(Result $result): void
    {
        $this->pushAlertNotification('success', $result->getMessage(), 'Success', 200, 5000);
    }

    protected function danger(Result $result): void
    {
        $this->pushAlertNotification('danger', $result->getMessage(), 'Error', 500, 5000);
    }

    protected function warning(Result $result): void
    {
        $this->pushAlertNotification('warning', $result->getMessage(), 'Warning', 200, 5000);
    }

    protected function info(Result $result): void
    {
        $this->pushAlertNotification('info', $result->getMessage(), 'Info', 200, 5000);
    }

    protected function resolve(): void
    {
        $result = $this->getResult();

        switch ($result->status()) {
            case ResultStatus::ACCEPTED:
                $this->success($result);
                break;
            case ResultStatus::DANGER:
                $this->danger($result);
                break;
            case ResultStatus::WARNING:
                $this->warning($result);
                break;
        }
    }

    protected function makeView(string $name, ...$params): Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse
    {
        // check if exists the view into table folder
        $folder = $this->getViewPath($name);

        if (View::exists($folder)) {
            $path = $this->getViewPath($name);
        }

        if (!isset($path))
            $path = 'layout.' . '404';


        $args = $this->getRecordParams();

        if ($name === 'index') {
            $result = $this->getResult();
            if ($result && $result->isAccepted()) {
                $args = array_merge($this->getPaginationParams(), $args);
                $args['pagination'] = $this->getResult()->get();
            } else {
                return $this->redirect('back');
            }
            $this->resolve();
        } elseif ($name == 'edit' || $name == 'show') {
            $result = $this->getResult();
            if ($result->isAccepted()) {
                $args['record'] = $this->getResult()->get();
            } else {
                return $this->redirect('back');
            }
            $this->resolve();
        }

        return view($path)->with(
            $this->getParams($args, ...$params)
        );
    }

    public function redirect(string $name = 'back', array...$params): RedirectResponse
    {
        $this->resolve();

        if ($this->getResult()->isAccepted() && $name !== 'back') {
            $route = $this->getRoute($name);
            $params = $this->getParams(...$params);
            $redirect = redirect()->route($route, $params);
        } else {
            $redirect = back();
        }

        return $redirect;
    }
}
