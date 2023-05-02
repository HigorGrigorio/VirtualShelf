<?php

namespace App\Core\Infra\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

trait HasPaginationArguments
{
    protected function getArgsOfPagination(Request $request): array
    {
        return array_merge([
            'search' => '',
            'page' => Config::get('app.pagination.default_index_page'),
            'limit' => Config::get('app.pagination.limit'),
            'limits' => Config::get('app.pagination.limits'),
        ], $request->all(['page', 'limit', 'search']));
    }
}
