<?php

namespace App\Providers;

use App\Http\Database\Contracts\AuthorRepository;
use App\Http\Database\Contracts\CategoryRepository;
use App\Http\Database\Contracts\CountryRepository;
use App\Http\Database\Contracts\LanguageRepository;
use App\Http\Database\Contracts\UserRepository;
use App\Http\Database\Repositories\AuthorRepository as AuthorRepositoryImpl;
use App\Http\Database\Repositories\CategoryRepository as CategoryRepositoryImpl;
use App\Http\Database\Repositories\CountryRepository as CountryRepositoryImpl;
use App\Http\Database\Repositories\LanguageRepository as LanguageRepositoryImpl;
use App\Http\Database\Repositories\UserRepository as UserRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private array $repositories = [
        CountryRepository::class => CountryRepositoryImpl::class,
        AuthorRepository::class => AuthorRepositoryImpl::class,
        LanguageRepository::class => LanguageRepositoryImpl::class,
        CategoryRepository::class => CategoryRepositoryImpl::class,
        UserRepository::class => UserRepositoryImpl::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
