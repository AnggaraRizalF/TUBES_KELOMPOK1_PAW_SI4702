<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login'); // Arahkan ke login jika belum login
        }

        // Pastikan user memiliki role 'user'
        if (Auth::user()->isUser()) { // Memanggil method isUser() dari model User
            return $next($request);
        }

        // Jika tidak, arahkan ke dashboard (jika admin) atau tampilkan error 403
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini sebagai user.');
        }

        abort(403, 'Unauthorized action. You do not have user privileges.'); // Tampilkan error 403 Forbidden
    }
}
