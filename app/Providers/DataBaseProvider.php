<?php

namespace App\Providers;

use App\Presentation\Helpers\DBHelper;
use App\Presentation\Helpers\Interfaces\IDataBase;
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
