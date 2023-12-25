<?php

namespace App\Providers;

use App\Service\CategoryService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CategoriesDisplayProvider extends ServiceProvider
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
        View::composer("admin.frontend.*", function ($view) {
            $categoryService = app(CategoryService::class);
            $view->with("categories",  $categoryService->getAllCategories());
        });
    }
}
