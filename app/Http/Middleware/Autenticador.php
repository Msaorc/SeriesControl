<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next'
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->is('home', 'registrar') && !Auth::check()) {
            return \redirect('home');
        }
        return $next($request);
    }
}
