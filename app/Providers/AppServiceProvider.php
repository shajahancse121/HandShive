<?php

namespace App\Providers;

use App\Category;
use App\CompanyProfile;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
//        $categories = Category::where('status',1)->get();
//        $company = CompanyProfile::where('id',1)->first();
//        View::share('categories', $categories);
//        View::share('company', $company);
    }
}
