<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This is the path to redirect to after login.
     */
    public const HOME = '/'; // <- arahkan ke homepage

    public function boot(): void
    {
        //
    }
}
