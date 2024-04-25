<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        return redirect()->route('index'); // Если пользователь не авторизован
    }
   

  $user = Auth::user();
    // dd($user);
    // Проверка роли пользователя
    if ($user->role_id === 2) {
        abort(403, 'Недостаточно прав.');
    }

        return $next($request);
    }
}	
