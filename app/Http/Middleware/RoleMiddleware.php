<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            return redirect('/home'); // إعادة توجيه المستخدم إذا لم يكن لديه الدور
        }

        return $next($request);
    }
}
