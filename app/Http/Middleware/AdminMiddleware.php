<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق من أن المستخدم مسجل دخول ودرجة حسابه admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // إذا لم يكن أدمن يتم توجيهه للصفحة الرئيسية
        return redirect('/')->with('error', 'غير مصرح لك بالدخول لهذه الصفحة');
    }
}
