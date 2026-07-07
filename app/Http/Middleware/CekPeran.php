<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware pembatas akses berdasarkan peran (role).
 *
 * Pemakaian di rute: ->middleware('peran:admin')
 * atau beberapa peran: ->middleware('peran:admin,pengelola')
 */
class CekPeran
{
    public function handle(Request $request, Closure $next, string ...$peran): Response
    {
        // Harus sudah login lebih dulu.
        if (! $request->user()) {
            return redirect()->route('login');
        }

        // Jika peran pengguna tidak termasuk yang diizinkan, tolak akses.
        if (! empty($peran) && ! in_array($request->user()->role, $peran, true)) {
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}
