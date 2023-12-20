<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
         // Проверка аутентификации пользователя
    if (!auth()->check()) {
        return $next($request);
    }

        // Проверка роли пользователя
        if (!auth()->check() && !auth()->user()->hasRole($role)) {
            abort(403, 'Недостаточно прав.');
        }
        return $next($request);
    }
}	
