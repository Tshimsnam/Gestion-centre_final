<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissionUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();
        try {
            if ($user->hasRole('admin') || $user->hasRole('superadmin')){
                return $next($request);
            } else {
                return redirect()->route('activitencours');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Vous n\'avez pas les droits pour accéder à cette page');
        }
    }

}