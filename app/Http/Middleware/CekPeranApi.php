<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware pembatas akses berdasarkan peran, khusus untuk API (return JSON).
 *
 * Pemakaian di rute: ->middleware('peran.api:admin')
 * atau beberapa peran: ->middleware('peran.api:admin,pengelola')
 */
class CekPeranApi
{
    public function handle(Request $request, Closure $next, string ...$peran): Response
    {
        if (! $request->user()) {
            return response()->json([
                'message' => 'Anda harus login terlebih dahulu.',
            ], 401);
        }

        if (! empty($peran) && ! in_array($request->user()->role, $peran, true)) {
            return response()->json([
                'message' => 'Anda tidak memiliki hak akses untuk aksi ini.',
            ], 403);
        }

        return $next($request);
    }
}