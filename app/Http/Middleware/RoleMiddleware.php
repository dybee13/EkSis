<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Cek apakah role user sesuai dengan yang diizinkan
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini!');
        }

        return $next($request);
    }
}
