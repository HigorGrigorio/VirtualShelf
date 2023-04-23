<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Password;

trait HasBroker
{
    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    protected function broker(): PasswordBroker
    {
        return Password::broker();
    }
}
