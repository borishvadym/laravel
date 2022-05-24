<?php

namespace App\Providers;

use App\Contracts\Services\ArticleServiceContract;
use App\Contracts\Services\CategoryServiceContract;
use App\Http\Services\ArticleService;
use App\Http\Services\CategoryService;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CategoryServiceContract::class, function () {
            return new CategoryService(new Category());
        });

        $this->app->singleton(ArticleServiceContract::class, function () {
            return new ArticleService(new Article());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultstringLength(191);
        Paginator::useBootstrap();
    }
}
