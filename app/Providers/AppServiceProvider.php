<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
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
        try {
            $SiteData = Setting::with('translations')->first();
            if ($SiteData === null):
                $SiteData = new Setting();
            endif;
            View::share('SiteData',$SiteData);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
}
