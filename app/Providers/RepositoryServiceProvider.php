<?php

namespace App\Providers;

use App\Repositories\AuthorRepository;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
    }
}
