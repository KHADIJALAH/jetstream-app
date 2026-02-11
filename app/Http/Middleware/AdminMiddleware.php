<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié et s'il est un admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Redirige vers la page d'accueil si l'utilisateur n'est pas admin
        return redirect('/')->with('error', 'Accès interdit');
    }
}
