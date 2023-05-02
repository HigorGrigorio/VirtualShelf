<?php

namespace App\Core\Infra\Traits;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Password;

trait HasBrokerMethods
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
