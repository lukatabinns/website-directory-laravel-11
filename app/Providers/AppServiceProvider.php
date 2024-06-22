<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function ($request) {
            if(auth()->check() && auth()->user()->is_admin){
                return Limit::perMinute(120)->by(auth()->user()->is_admin);
            }

            if(auth()->user()){
                return Limit::perMinute(60)->by(auth()->user());
            }

            return Limit::perMinute(30)->by($request->ip());
        });
    }
}
