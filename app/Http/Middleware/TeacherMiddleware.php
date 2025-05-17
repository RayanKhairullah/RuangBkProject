<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === UserRole::Teacher && $request->route()->getName() === 'dashboard') {
            return redirect()->route('teacher.dashboard');
        }
        if (!in_array(Auth::user()->role, ['user', 'teacher'])) {
            abort(403, 'Akses ditolak.');
        }
        
        return $next($request);
    }
    
}
