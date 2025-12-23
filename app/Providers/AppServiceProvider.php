<?php

namespace App\Providers;

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
        try {
            $profil = \App\Models\ProfilDinas::first();
            \Illuminate\Support\Facades\View::share('profil', $profil);
        } catch (\Exception $e) {
            // Handle case where table might not exist yet (e.g. during migration)
        }
    }
}
