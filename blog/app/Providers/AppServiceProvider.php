<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Blogroll;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $blogroll=Blogroll::orderBy('id','desc')->paginate(4);
        View::share('blogroll',$blogroll);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
