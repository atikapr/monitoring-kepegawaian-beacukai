<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Gunakan Auth::check() untuk memastikan metode dikenali
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Redirect jika bukan admin
        return redirect()->route('dashboard')->with('error', 'Akses tidak diizinkan.');
    }
}
