<?php

namespace App\Providers;

use App\Mixins\ArrayMixin;
use App\Mixins\StrMixins;
use App\Mixins\TranslateMixin;
use App\Service\BookService;
use App\Service\CategoryCreateService;
use App\Service\CategoryService;
use App\Service\MyCartService;
use App\Service\UserService;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Translation\Translator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookService::class, function () {
            return new BookService();
        });
        $this->app->bind(CategoryService::class, function () {
            return new CategoryService();
        });
        $this->app->bind(UserService::class, function () {
            return new UserService();
        });

        $this->app->bind('cartService', function () {
            return new MyCartService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Str::macro('isLength', function ($str, $length) {
        //     return static::length($str) == $length;
        // });

        // Str::macro('appendTo', function ($str, $char) {
        //     return $str . $char;
        // });        Collection::mixin(new ArrayMixin);
        Str::mixin(new StrMixins);
    }
}
