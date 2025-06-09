<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotAuthenticatedToRegister
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            // Redirect ke register page jika belum login
            return redirect()->route('register');
        }

        return $next($request);
    }
}
