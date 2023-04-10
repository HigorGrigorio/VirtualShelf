<?php

namespace App\Providers;

use App\Interfaces\IDataBase;
use App\Utils\DataBase;
use Illuminate\Support\ServiceProvider;

class DataBaseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IDataBase::class,
            DataBase::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
