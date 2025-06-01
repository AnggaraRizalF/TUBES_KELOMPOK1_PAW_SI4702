<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user terautentikasi dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Jika tidak, arahkan ke halaman utama atau tampilkan error 403
        // return redirect('/'); // Arahkan ke halaman utama
        abort(403, 'Unauthorized action.'); // Tampilkan error 403 Forbidden
    }
}
