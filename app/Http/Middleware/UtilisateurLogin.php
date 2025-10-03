<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilisateurLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
 //   public function handle(Request $request, Closure $next)
   // {
     //   return $next($request);
   // }


    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l’utilisateur est connecté
        if (!Auth::guard('utilisateur')->id()) {
            // Rediriger vers la page de login si non connecté
            return redirect()->route('LoginUser')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }
        

        return $next($request);
    }
}
