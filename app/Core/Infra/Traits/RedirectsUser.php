<?php

namespace App\Core\Infra\Traits;

use App\Providers\RouteServiceProvider;

trait RedirectsUser
{
    /**
     * The redirect route
     *
     * @return string
     */
    public function redirectPath(): string
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : RouteServiceProvider::HOME;
    }
}
