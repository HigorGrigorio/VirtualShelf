<?php

namespace App\Providers;

use App\Presentation\Contracts\IDataBase;
use App\Presentation\Helpers\DBHelper;
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
