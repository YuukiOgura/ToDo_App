<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
<<<<<<< HEAD
        //
        if (config('app.env') === 'production') {
          URL::forceScheme('https');
=======
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
>>>>>>> 9a8a61e78280b24e582b463baf8b43fdb3a245b3
        }
    }
}
