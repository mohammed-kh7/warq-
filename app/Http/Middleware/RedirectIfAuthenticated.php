<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // تأكد من أن $guards هو مصفوفة
        $guards = (array) $guards; // تأكد من أن $guards هو مصفوفة
        $guards = !empty($guards) ? $guards : [null]; // تأكد من أن $guards ليست فارغة

        // التحقق من كل guard
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // تنفيذ الطلب إذا لم يكن المستخدم مصدقًا
        return $next($request);
    }
}
