<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Accessibility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && ! $request->user()->active) abort(403, 'Sorry, the system detects that this account has been deactivated.');

        return $next($request);
    }
}
