<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

trait HasGuard
{
    protected function guard(): Guard|\Illuminate\Contracts\Auth\StatefulGuard
    {
        return Auth::guard();
    }
}
