<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // تحديث اللغة من الجلسة أو القيمة الافتراضية
        $locale = session()->get('locale', config('app.locale'));
        
        // تحديث اللغة في التطبيق
        app()->setLocale($locale);
        
        // تخزين اللغة في الجلسة إذا لم تكن موجودة
        if (!session()->has('locale')) {
            session()->put('locale', $locale);
        }

        // تمرير اللغة الحالية إلى كل الـ views
        view()->share('currentLocale', $locale);

        return $next($request);
    }
}
