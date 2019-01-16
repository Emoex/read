<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Blogroll;
use App\Models\Conf;
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
        $title = Conf::where('name','title')->first()->content;
        $logo = Conf::where('name','logo')->first();
        $slide = Conf::where('name','slide')->get();
        View::share(['blogroll'=>$blogroll,'title'=>$title,'logo'=>$logo,'slide'=>$slide]);
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
