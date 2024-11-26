<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Si l'utilisateur est connecté mais n'a pas de rôle
        if ($user = Auth::user()) {
            if (!$user->hasAnyRole($roles)) {
                // Rediriger vers la page d'accueil
                return redirect()->route('home')->with('error', 'Vous n\'avez pas accès à cette page.');
            }
        } else {
            // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        return $next($request);
    }
}