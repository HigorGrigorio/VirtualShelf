<?php

namespace App\Providers;

use App\Interfaces\IDataBase;
use App\Helpers\DBHelper;
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
            DBHelper::class
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
