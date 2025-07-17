<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfHasBiodata
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->biodata) {
            return redirect()->route('student.biodatas.view');
        }

        return $next($request);
    }
}
