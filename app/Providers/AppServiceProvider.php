<?php

namespace App\Providers;

use App\Policies\HabitationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('update-habit', [HabitationPolicy::class, 'canUpdateOrDelete']);
        Gate::define('destroy-habit', [HabitationPolicy::class, 'canUpdateOrDelete']);
    }
}
