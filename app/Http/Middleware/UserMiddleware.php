<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (in_array('admin', $roles) && $user->role === 'admin') {
            return $next($request);
        }

        if (in_array('petugas', $roles) && $user->role === 'petugas') {
            return in_array($request->route()->getName(), ['order.index', 'konsumen.index', 'home']) ? $next($request) : abort(403);
        }

        if (in_array('pemimpin', $roles) && $user->role === 'pemimpin') {
            return in_array($request->route()->getName(), ['order.index', 'home']) ? $next($request) : abort(403);
        }

        return abort(403);
    }
}
