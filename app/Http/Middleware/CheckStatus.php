<?php

namespace App\Http\Middleware;

use Closure;

class CheckStatus
{
    /** * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle($request, Closure $next): Response
    {
        if (auth()->user()->status == 'active') {
            return $next($request);
        }
        return response()->json('Your account is inactive');
    }
}
