<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Gérer la requête entrante.
     */
    public function handle(Request $request, Closure $next)
    {
        // On vérifie si l'utilisateur est connecté et a un rôle d'administrateur (role == 1)
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }

        // Rediriger les non-administrateurs vers une autre page avec un message d'erreur
        return redirect('/dashboard')->with('error', "Accès refusé. Vous n'êtes pas administrateur.");
    }
}