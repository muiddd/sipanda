<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();


            if ($user->role === 'admin') {
                    return $next($request);
            }
            if ($user->role === 'user' && !$request->is('sipanda/logout*')) { 
                return redirect('/');
            }
        }

        return $next($request);
    }
}
