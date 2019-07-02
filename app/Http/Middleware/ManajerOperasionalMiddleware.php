<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

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
            return new Response(view('restricted')->with('role', 'ManajerOperasional'));
        }

        return $next($request);
    }
}