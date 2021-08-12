<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\ProfileComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('dashboard.layout.header', 'App\Http\View\Composers\UserInfoComposer');
        view()->composer('dashboard.layout.nav', 'App\Http\View\Composers\UserInfoComposer');
        view()->composer('dashboard.layout.master', 'App\Http\View\Composers\UserInfoComposer');
        view()->composer('dashboard.layout.profileHeader', 'App\Http\View\Composers\UserInfoComposer');
        view()->composer('dashboard.home.changePassword', 'App\Http\View\Composers\UserInfoComposer');
        view()->composer('dashboard.home.profile', 'App\Http\View\Composers\UserInfoComposer');
        view()->composer('dashboard.user.show', 'App\Http\View\Composers\UserInfoComposer');


        view()->composer('homeuser.layout.header', 'App\Http\View\Composers\UserHomeComposer');
    }
}
