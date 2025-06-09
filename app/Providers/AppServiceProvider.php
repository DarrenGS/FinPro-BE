<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    public const HOME = '/';

    public function boot(): void
    {
        Route::middleware('web')->group(function () {
            Route::get('/redirect-after-login', function () {
                $user = Auth::user();
                if ($user && $user->role === 'admin') {
                    return redirect('/admin');
                }
                return redirect('/');
            });
        });
    }
}
