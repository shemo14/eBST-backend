<?php

namespace App\Providers;

use App\Models\AppSetting;
use App\Models\Report;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $reports = Report::latest()->paginate(8);
        $setting = AppSetting::find( 1);
        $siteName = $setting->site_name;
        \View::share('reports', $reports);
        \View::share('siteName', $siteName);
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
