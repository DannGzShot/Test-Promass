<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        if (Schema::hasTable('categories') && Schema::hasTable('users')) {

            $categories = \App\Models\Category::all();
            $authors = \App\Models\User::all();
            $posts = \App\Models\Post::take(8)->inRandomOrder()->get();
            View::share('categories', $categories);
            View::share('authors', $authors);
            View::share('posts', $posts);
        }
    }

}

