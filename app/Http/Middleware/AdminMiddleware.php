<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Jangan lupa tambahkan ini
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Jika belum login sama sekali, lempar ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Jika user sudah login dan rolenya SESUAI dengan yang diminta, izinkan lewat
        if (Auth::user()->role == $role) {
            return $next($request);
        }

        // 3. Jika rolenya TIDAK SESUAI (misal pelanggan mencoba buka link admin), tolak!
        // Bisa diredirect ke '/' atau tampilkan error 403 Forbidden
        return abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk halaman ini.');
    }
}