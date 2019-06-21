<?php

namespace App\Http\Middleware;

use Closure;

class ManajerOperasionalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role != 1) {
            return new Response(view('restricted')->with('role', 'Manajer Operasional'));
        }

        return $next($request);
    }
}