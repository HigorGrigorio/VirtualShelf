<?php

namespace App\Core\Infra\Traits;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;

trait HasGuardMethods
{
    protected function guard(): Guard|StatefulGuard
    {
        return Auth::guard();
    }
}
