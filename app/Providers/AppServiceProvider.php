<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Post;
use App\Models\Category;

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
        // to share data to all view
        // recent_post is a variable
        View::share('recent_post',Post::orderBy('created_at','DESC')->limit(5)->get()); 
        // to show the post puplular base on view
        View::share('popular_post',Post::orderBy('views','DESC')->limit(5)->get()); 
        // for show all categories in header menu
        View::share('allCategories',Category::orderBy('title','DESC')->get()); 
    }
}
