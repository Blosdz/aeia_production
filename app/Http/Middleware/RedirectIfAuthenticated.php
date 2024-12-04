<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */

     public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->rol;
            
                switch ($role) {
                    case 1:
                        return redirect('/admin/home');
                    case 2:
                        return redirect('/suscriptor/home');
                    case 3:
                    case 4:
                        return redirect('/user/home');
                    case 5:
                        return redirect('/gerente/home');
                    case 6:
                        return redirect('/verificador/home');
                    case 8:
                        return redirect('/banco/home');
                    default:
                        return redirect('/start'); // Ruta por defecto.
                }
            }
        }
    
        return $next($request);
    }

}
