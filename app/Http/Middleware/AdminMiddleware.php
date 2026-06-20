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
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role == $role) {
            return $next($request);
        }

        return abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk halaman ini.');
    }
}