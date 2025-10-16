<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        // 2. Cek apakah pengguna yang login memiliki kolom 'is_admin' bernilai true (atau 1)
        if (Auth::check() && Auth::user()->is_admin) {
            // Jika ya, izinkan untuk melanjutkan ke halaman yang dituju
            return $next($request);
        }

        // Jika tidak memenuhi syarat, tendang pengguna kembali ke halaman utama
        return redirect('/');
    }
}